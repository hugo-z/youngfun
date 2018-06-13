<?php

namespace App\Modules\Babyfun\Models;

use Illuminate\Database\Eloquent\Model;

class ParentInfo extends Model
{
    protected $table = 'parent_info';

    protected $fillable = [
        'uniqueid',
        'cell',
        'nickname',
        'gender',
        'city',
        'province',
        'country',
        'lang'
    ];

    /**
     * Store parent's info
     *
     * @param array $parentData
     * @return int
     */
    public static function storeParents ($parentData)
    {
        array_walk ($parentData, function ($value, $key) use(&$parentData) {
            if ('gender' === $key)
                $parentData['gender'] = $value == 1 ? 'm' : 'f';
        });

        $result = self::create($parentData);

        return $result->id;
    }
}
