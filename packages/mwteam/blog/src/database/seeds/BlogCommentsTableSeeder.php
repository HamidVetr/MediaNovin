<?php

namespace Mwteam\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Mwteam\Blog\App\Models\BlogArticle;
use Mwteam\Blog\App\Models\BlogComment;

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

        foreach (range(1,5000) as $index) {
            $article_id = rand(1, 200);
            BlogComment::create([
                'blog_article_id' => $article_id,
                'name' => $faker->firstName,
                'email' => $faker->email,
                'body' => $faker->realText(150),
                'approved' => rand(0, 1),
            ]);

            BlogArticle::find($article_id)->increment('comments');
        }
    }
}
