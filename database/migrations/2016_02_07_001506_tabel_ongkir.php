<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelOngkir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ongkirs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kurir_id')->unsigned();
            $table->string('tipe'); // kota / kecamatan / kelurahan
            $table->string('origin', 20); // kode origin
            $table->string('destination', 20); // kode destination
            $table->integer('weight')->unsigned(); // weight in gram
            $table->integer('ongkir')->unsigned(); // ongkir in currency
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ongkirs');
    }
}
