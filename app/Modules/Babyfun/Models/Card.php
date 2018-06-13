<?php

namespace App\Modules\Babyfun\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Card extends Model
{
    protected $fillable = [
        'slug',
        'path',
        'type'
    ];

    /**
     * Get cards of associated type from redis
     *
     * @param int $type
     * @return string
     */
    public function fetchCardsWithType ($type)
    {
        $exsited = Redis::exists('card:' . $type);
        
        if (!$exsited) {
            $cards = self::where(['type' => $type])
                            ->select(['id', 'slug', 'path', 'fr', 'cn'])
                            ->get()->toJson();
            Redis::hmset("card:$type", [$type => $cards]);
        }

        $allCardsOfType = Redis::hgetall("card:$type");
        
        return $allCardsOfType;
    }

    public function fetchCardsWithTypeDetail ($type, $detail)
    {
        $exsited = Redis::exists("card:$type:$detail");
    
        if (!$exsited) {
            $cards = self::where(['type' => $type, 'slug' => $detail])
                            ->select(['id', 'slug', 'path', 'fr'])
                            ->first()
                            ->toArray();
            Redis::hmset("card:$type:$detail", $cards);
        }

        $allCardsOfType = Redis::hmget("card:$type:$detail", ['id', 'slug', 'path', 'fr']);
        
        return $allCardsOfType;
    }
}
