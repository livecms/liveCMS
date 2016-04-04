<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_media_socials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('social');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('role');
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

        Schema::create('team_team_media_socials', function (Blueprint $table) {
            $table->integer('team_id')->unsigned();
            $table->integer('team_media_social_id')->unsigned();

            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade');

            $table->foreign('team_media_social_id')
                  ->references('id')->on('team_media_socials')
                  ->onDelete('cascade');

            $table->primary(['team_id', 'team_media_social_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('team_team_media_socials');
        Schema::drop('teams');
        Schema::drop('team_media_socials');
    }
}
