<?php

namespace App\Modules\Babyfun\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\Babyfun\Models\WeChat;

class WeChatController extends Controller
{
    private $app;

    private $wechat;

    public function __construct ()
    {
        $this->app = app('wechat.mini_program');
        $this->wechat = new WeChat;
    }

    public function index ()
    {

    }

    public function fetchSessionId ($code)
    {
        $sessionSet = $this->app->auth->session((string) $code);
        $session_id = $this->wechat->saveLoginSessions($sessionSet);

        return response()->json($this->wechat->getSessionKey($session_id));
    }
}
