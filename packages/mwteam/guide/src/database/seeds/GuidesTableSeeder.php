<?php

namespace Mwteam\Guide\Database\Seeds;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Mwteam\Guide\App\Models\Guide;

class GuidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_articles')->truncate();
        $faker = Faker::create("fa_IR");

        foreach (range(1,100) as $index) {
            $data = [
                'guide_category_id' => rand(1, 20),
                'title' => $faker->firstName,
                'body' => $faker->realText(700),
                'author_id' => '5',
            ];

            Guide::create($data);
        }
    }
}
