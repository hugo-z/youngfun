<?php

namespace App\Modules\Babyfun\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\Babyfun\Models\WeChat;
use App\Modules\Babyfun\Models\BabyInfo;
use App\Modules\Babyfun\Models\ParentInfo;
use App\Modules\Babyfun\Models\WeChatOpenIds;
// use Illuminate\Support\Facades\Redis;

use Validator;

class WeChatController extends Controller
{
    private $app;

    private $wechat;

    private $openId;

    public function __construct (Request $request)
    {
        $this->app = app('wechat.mini_program');
        $this->wechat = new WeChat;
        $this->request = $request;
    }

    public function index ()
    {
        dd(Redis::hgetall("eyJpdiI6ImtRaTFSXC9WZGNEb2ZaN2dEQ3FhV2lBPT0iLCJ2YWx1ZSI6Ik5UVHpXK2w3MGpRNDVIXC9RenNVMDIramk2YzErNUhCOE5DR3g5a1VJWlk0PSIsIm1hYyI6IjI0ZWE1NGU0MzFmM2ZhYzdiNGM0MmIwNWVkN2Y0MjJhMzA0MDA0YmFmNGE5NDFjMWZjY2QyZGMyODZmMzA2MTgifQ=="));
    }

    public function fetchSessionId ($code)
    {
        // Get the expired server_sid
        $old_server_sid = $this->request->input('server_sid');

        // Get the code by miniapp loging in
        $sessionSet = $this->app->auth->session((string) $code);

        // Pass the new session set (openid, session_key) and the possible old server sid set previously to model
        $session_id = $this->wechat->saveLoginSessions($sessionSet, $old_server_sid);

        return response()->json([
            'server_sid' => $session_id, 
            'open_id' => $sessionSet['openid']
        ]);
    }

    /**
     * 
     *
     * @param [type] $uniqueId
     * @return void
     */
    public function checkInFamilyData ($uniqueId = null)
    {
        // Validate the input data
        $validator = Validator::make($inputData = $this->request->all(), [
            // parent data
            'uniqueid'          => 'unique:parent_info|nullable',
            'parent_cell'       => 'unique:parent_info|digis:11',
            'parent_nickname'   => 'required',
            'parent_city'       => 'required|string',
            'parent_province'   => 'required|string',
            'parent_country'    => 'required|string',
            'parent_lang'       => 'required|string',

            // kid data
            'kid_name'          => 'required|min:1|max:10',
            'kid_gender'        => 'required', // TODO: add rules later
            'kid_bday'          => 'required', // TODO: add rules later
            'server_session_id' => 'required'
        ]);
        
        $errors = $validator->errors();

        // If no errors at all
        if ($errors->isEmpty()) {
            // First format the incoming family data
            $formattedFamily = $this->formatInput($inputData);

            // Then deal with the parent's data
            $pid = ParentInfo::storeParents($formattedFamily['parent']);

            // Then deal with the kid's data
            BabyInfo::storeKids($formattedFamily['kid'], $pid);

            // Lastly, we deal with the connection 
            $connectionArray['pid'] = $pid;
            $connectionArray['openid'] = WeChat::getOpenId($inputData['server_session_id']);

            WeChatOpenIds::storeConnections($connectionArray);
        }
        
        return response()->json($errors);
    }

    /**
     * Rename the key of the incoming family array
     *
     * @param array $inputArr   
     * @return void
     */
    private function formatInput ($inputArr)
    {
        $result = [];
        $newKey = '';

        array_walk($inputArr, function ($value, $key) use(&$result, $newKey) {
            $prefix = strstr($key, '_', true);
            $newKey = substr($key, strlen($prefix) + 1);

            switch ($prefix) {
                case 'parent':
                    $result['parent'][$newKey] = $value;
                    break;
                case 'kid':
                    $result['kid'][$newKey] = $value;
                    break;
            }
        });

        return $result;
    }

    // public function 
}
