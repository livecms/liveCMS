<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->integer('author_id')->unsigned();
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');

            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict');
        });

        Schema::create('project_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('category');
            $table->string('slug');
            $table->timestamps();

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->integer('author_id')->unsigned();
            $table->string('picture')->nullable();
            $table->integer('client_id')->unsigned();
            $table->timestamps();

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');

            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict');

            $table->foreign('client_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict');
        });

        Schema::create('project_project_categories', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('project_id')
                  ->references('id')->on('projects')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')->on('project_categories')
                  ->onDelete('cascade');

            $table->primary(['project_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_project_categories');
        Schema::drop('project_categories');
        Schema::drop('projects');
        Schema::drop('clients');
    }
}
