<?php

namespace App\Modules\Babyfun\Models;

use Illuminate\Database\Eloquent\Model;

class BabyInfo extends Model
{
    //
    protected $table = 'baby_info';

    protected $fillable = [
        'pid',
        'name',
        'gender',
        'bday'
    ];

    public static function storeKids ($kidsData, $pid)
    {
        $kidsData['pid'] = $pid;
        
        self::create($kidsData);
    }
}
