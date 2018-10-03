<?php

namespace Mwteam\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BlogTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_tags')->truncate();
        $faker = Faker::create("fa_IR");
        $tags = [];
        $time = \Carbon\Carbon::now();

        foreach (range(1, 50) as $index){
            $tags[] = [
                'fa_name' => $faker->firstName,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }

        DB::table('blog_tags')->insert($tags);
    }
}
