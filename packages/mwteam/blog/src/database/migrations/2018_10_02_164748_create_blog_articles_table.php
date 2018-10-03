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
            $table->unsignedInteger('author')->nullable(false);
            $table->unsignedInteger('editor')->nullable(true);
            $table->string('fa_title')->nullable(false);
            $table->string('en_title')->nullable(true);
            $table->string('fa_slug')->nullable(true);
            $table->string('en_slug')->nullable(true);
            $table->string('fa_description')->nullable(true);
            $table->string('en_description')->nullable(true);
            $table->text('fa_body')->nullable(false);
            $table->text('en_body')->nullable(true);
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
