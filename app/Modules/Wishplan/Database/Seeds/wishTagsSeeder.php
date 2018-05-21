<?php

namespace App\Modules\Wishplan\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Carbon\Carbon;

class wishTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker;
        // dd($faker);
        foreach (range(1, 10) as $tag) {
            DB::table('wish_tags')->insert([
                'name'  => str_random(10),
                'user_id' => rand(1, 10),
                'is_checked' => 'false',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        // factory(App\Modules\Wishplan\Models\WishTags::class, 10)->create();
    }
}
