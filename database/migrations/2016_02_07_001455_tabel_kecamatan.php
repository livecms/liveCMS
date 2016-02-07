<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKecamatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kecamatan');
            $table->string('kode_pos', 5);
            $table->integer('kota_id')->unsigned();
            $table->timestamps();

            $table->foreign('kota_id')
              ->references('id')->on('kotas')
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
        Schema::drop('kecamatans');
    }
}
