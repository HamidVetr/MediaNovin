<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_article_id')->nullable(false);
            $table->unsignedInteger('parent_id')->nullable(true);
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(true);
            $table->string('mobile', 15)->nullable(true);
            $table->text('body')->nullable(false);
            $table->boolean('approved')->nullable(false)->default(false);
            $table->text('admin_reply')->nullable(true);
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
        Schema::dropIfExists('blog_comments');
    }
}
