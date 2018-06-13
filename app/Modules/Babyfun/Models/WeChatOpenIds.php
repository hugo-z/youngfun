<?php

namespace App\Modules\Babyfun\Models;

use Illuminate\Database\Eloquent\Model;

class WeChatOpenIds extends Model
{
    protected $table = 'parent_openid';

    protected $fillable = [
        'openid',
        'pid'
    ];

    public static function storeConnections($connection)
    {
        self::create($connection);
    }
}
