<?php

namespace App\Modules\Wishplan\Models;

use Illuminate\Database\Eloquent\Model;

class WishTags extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'is_checked'
    ];
}
