<?php

namespace Mwteam\Guide\Database\Seeds;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GuideCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guide_categories')->truncate();
        $faker = Faker::create("fa_IR");
        $categories = [];
        $time = \Carbon\Carbon::now();

        foreach (range(1, 20) as $index){
            $categories[] = [
                'name' => $faker->firstName,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }

        DB::table('guide_categories')->insert($categories);
    }
}
