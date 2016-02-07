<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('penerima');
            $table->string('email');
            $table->string('no_hp', 12);
            $table->text('alamat');
            $table->integer('propinsi_id')->unsigned()->nullable();
            $table->integer('kota_id')->unsigned()->nullable();
            $table->integer('kecamatan_id')->unsigned()->nullable();
            $table->integer('kelurahan_id')->unsigned()->nullable();
            $table->string('kodepos', 5);
            $table->integer('jumlah');
            $table->integer('diskon');
            $table->integer('kurir_id')->unsigned()->nullable();
            $table->integer('weight');
            $table->integer('ongkir');
            $table->integer('metode_pembayaran_id')->unsigned()->nullable();
            $table->string('kode_pesanan', 6)->nullable();
            $table->datetime('waktu_pesanan');
            $table->datetime('waktu_pengiriman')->nullable();
            $table->string('no_resi_pengiriman', 50)->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('status', 20);
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('propinsi_id')->references('id')->on('propinsis')->onDelete('set null');
            $table->foreign('kota_id')->references('id')->on('kotas')->onDelete('set null');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans')->onDelete('set null');
            $table->foreign('kurir_id')->references('id')->on('kurirs')->onDelete('set null');
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
        Schema::drop('pesanans');
    }
}
