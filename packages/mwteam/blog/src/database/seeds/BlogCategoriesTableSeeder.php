<?php

namespace Mwteam\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->truncate();
        $faker = Faker::create("fa_IR");
        $categories = [];
        $time = \Carbon\Carbon::now();

        foreach (range(1, 20) as $index){
            $categories[] = [
                'fa_name' => $faker->firstName,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}
