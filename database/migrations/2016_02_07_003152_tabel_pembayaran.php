<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pesanan_id')->unsigned()->nullable();
            $table->integer('metode_pembayaran_id')->unsigned()->nullable();
            $table->integer('jumlah')->unsigned();
            $table->string('bukti');
            $table->datetime('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('set null');
            $table->foreign('metode_pembayaran_id')->references('id')->on('metode_pembayarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pembayarans');
    }
}
