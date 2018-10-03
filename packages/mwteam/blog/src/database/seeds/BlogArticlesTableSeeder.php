<?php

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

        foreach (range(1,200) as $index) {
            $article = BlogArticle::create([
                'blog_category_id' => rand(1, 20),
                'fa_title' => $faker->firstName,
                'fa_slug' => str_replace(' ', '-', $faker->name),
                'body' => $faker->realText(700),
                'author' => '1',
            ]);

            $tags_count = rand(1, 50);
            $tags = [];

            for ($i = 1; $i <= $tags_count; $i++){
                $tags[] = rand(1, 50);
            }

            $article->tags()->attach($tags);
        }
    }
}
