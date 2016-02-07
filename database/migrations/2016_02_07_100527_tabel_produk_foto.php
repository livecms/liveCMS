<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelProdukFoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto');
            $table->string('keterangan');
            $table->integer('produk_id')->unsigned();
            $table->timestamps();

            $table->foreign('produk_id')
              ->references('id')->on('produks')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produk_fotos');
    }
}
