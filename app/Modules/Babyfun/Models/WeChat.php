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
    public function saveLoginSessions ($sessionSet, $expireIn = 30)
    {
        // return $sessionSet['openid'];
        $session_id = self::generate3rdSessionId($sessionSet['openid']);
        Redis::hmset ($session_id, $sessionSet);

        return $session_id;
    }

    public function getSessionKey ($session_id)
    {
        return Redis::hgetall ($session_id);
    }

    private static function generate3rdSessionId ($openId)
    {
        return Crypt::encryptString ($openId);
    }
}
