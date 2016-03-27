<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelStaticPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->integer('author_id')->unsigned();
            $table->string('picture')->nullable();
            $table->date('published_at');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');

            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict');

            $table->foreign('parent_id')
                  ->references('id')->on('static_pages')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('static_pages');
    }
}
