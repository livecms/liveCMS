<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKelurahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 20)->unique();
            $table->string('kelurahan');
            $table->string('tipe', 20);
            $table->string('kode_pos', 5);
            $table->integer('kecamatan_id')->unsigned();
            $table->timestamps();

            $table->foreign('kecamatan_id')
              ->references('id')->on('kecamatans')
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
        Schema::drop('kelurahans');
    }
}
