<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_category_id')->nullable(false);
            $table->unsignedInteger('author_id')->nullable(false);
            $table->unsignedInteger('editor_id')->nullable(true);
            $table->unsignedInteger('parent_id')->nullable(true);
            $table->char('language', '2')->nullable(false)->default('fa');
            $table->string('image')->nullable(true);
            $table->string('title')->nullable(false);
            $table->string('slug')->nullable(true);
            $table->string('description')->nullable(true);
            $table->text('body')->nullable(false);
            $table->unsignedInteger('comments')->nullable(false)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_articles');
    }
}
