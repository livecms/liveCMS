<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('slug');
            $table->longText('isi');
            $table->timestamps();
        });

        Schema::create('artikel_tags', function(Blueprint $table) {
            $table->integer('artikel_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('artikel_id')
                  ->references('id')->on('artikels')
                  ->onDelete('cascade');

            $table->foreign('tag_id')
                  ->references('id')->on('tags')
                  ->onDelete('cascade');

            $table->primary(['artikel_id', 'tag_id']);
        });

        Schema::create('artikel_kategoris', function(Blueprint $table) {
            $table->integer('artikel_id')->unsigned();
            $table->integer('kategori_id')->unsigned();

            $table->foreign('artikel_id')
                  ->references('id')->on('artikels')
                  ->onDelete('cascade');

            $table->foreign('kategori_id')
                  ->references('id')->on('kategoris')
                  ->onDelete('cascade');

            $table->primary(['artikel_id', 'kategori_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artikel_tags');
        Schema::drop('artikel_kategoris');
        Schema::drop('artikels');
    }
}
