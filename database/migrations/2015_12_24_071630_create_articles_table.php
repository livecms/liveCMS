<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('article_tags', function(Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('article_id')
                  ->references('id')->on('articles')
                  ->onDelete('cascade');

            $table->foreign('tag_id')
                  ->references('id')->on('tags')
                  ->onDelete('cascade');

            $table->primary(['article_id', 'tag_id']);
        });

        Schema::create('article_categories', function(Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('article_id')
                  ->references('id')->on('articles')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->primary(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_tags');
        Schema::drop('article_categories');
        Schema::drop('articles');
    }
}
