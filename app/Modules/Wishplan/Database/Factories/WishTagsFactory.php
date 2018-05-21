<?php

use Faker\Generator as Faker;


$factory->define(App\Modules\Wishplan\Models\WishTags::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => $faker->numberBetween(1,10),
    ];
});