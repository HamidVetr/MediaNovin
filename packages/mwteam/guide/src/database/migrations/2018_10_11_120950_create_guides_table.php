<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('guide_category_id')->nullable(false);
            $table->unsignedInteger('author_id')->nullable(false);
            $table->unsignedInteger('editor_id')->nullable(true);
            $table->unsignedInteger('parent_id')->nullable(true);
            $table->char('language', '2')->nullable(false)->default('fa');
            $table->string('title')->nullable(false);
            $table->text('body')->nullable(false);
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
        Schema::dropIfExists('guides');
    }
}
