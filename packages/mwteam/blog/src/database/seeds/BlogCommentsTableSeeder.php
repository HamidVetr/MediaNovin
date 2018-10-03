<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BlogCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_comments')->truncate();
        $faker = Faker::create("fa_IR");
        $comments = [];
        $time = \Carbon\Carbon::now();

        foreach (range(1, 5000) as $index){
            $comments[] = [
                'blog_article_id' => rand(1, 200),
                'name' => $faker->firstName,
                'email' => $faker->email,
                'body' => $faker->realText(150),
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }

        DB::table('blog_comments')->insert($comments);
    }
}
