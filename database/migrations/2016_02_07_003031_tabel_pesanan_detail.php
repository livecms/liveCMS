<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPesananDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pesanan_id')->unsigned();
            $table->integer('produk_id')->unsigned()->nullable();
            $table->string('produk');
            $table->integer('harga');
            $table->integer('quantity');
            $table->integer('diskon');
            $table->integer('jumlah');
            $table->timestamps();
           
            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesanan_details');
    }
}
