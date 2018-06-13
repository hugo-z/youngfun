<?php

namespace App\Modules\Babyfun\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Crypt;

class WeChat extends Model
{
    /**
     * Undocumented function
     *
     * @param array $sessionSet     includes session_key & open_id
     * @param integer $expireIn     the session_key expiration time - days
     * @return 
     */
    public function saveLoginSessions ($sessionSet, $oldSessionSid, $expireIn = 30)
    {
        // first check the old session id
        if ($oldSessionSid) {
            // if there is and old session sid, remove it from session
            Redis::del ($oldSessionSid);
        }

        // The generate a new server session sid
        $session_id = Crypt::encryptString ($sessionSet['openid']);

        // and relate it to the session set
        Redis::hmset ($session_id, $sessionSet);

        // return the newly generated server session sid
        return $session_id;
    }

    public static function getOpenId ($server_id)
    {
        $session_set = Redis::hgetall ($server_id);

        return $session_set['openid'];
    }

}
