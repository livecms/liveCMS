<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('produk');
            $table->string('slug')->unique();
            $table->integer('produk_kategori_id')->unsigned()->nullable();
            $table->integer('harga')->unsigned();
            $table->integer('harga_diskon')->unsigned();
            $table->text('deskripsi');
            $table->integer('netto');
            $table->string('foto');
            $table->integer('produk_brand_id')->unsigned()->nullable();
            $table->integer('stock')->unsigned();
            $table->timestamps();

            $table->foreign('produk_kategori_id')->references('id')->on('produk_kategoris')->onDelete('set null');
            $table->foreign('produk_brand_id')->references('id')->on('produk_brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produks');
    }
}
