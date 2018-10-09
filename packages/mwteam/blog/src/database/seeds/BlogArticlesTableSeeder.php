<?php

namespace Mwteam\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Mwteam\Blog\App\Models\BlogArticle;

class BlogArticlesTableSeeder extends Seeder
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
                'blog_category_id' => rand(1, 20),
                'title' => $faker->firstName,
                'slug' => str_replace(' ', '-', $faker->name),
                'description' => $faker->realText(100),
                'body' => $faker->realText(700),
                'author_id' => '1',
            ];

            $article = BlogArticle::create($data);

            $tags_count = rand(1, 50);
            $tags = [];

            for ($i = 1; $i <= $tags_count; $i++){
                $new_tag = rand(1, 50);
                if (!in_array($new_tag, $tags)){
                    $tags[] = $new_tag;
                }
            }

            $article->tags()->attach($tags);
        }
    }
}
