<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kota');
            $table->string('tipe', 20);
            $table->string('kode_pos', 5);
            $table->integer('propinsi_id')->unsigned();
            $table->timestamps();

            $table->foreign('propinsi_id')
              ->references('id')->on('propinsis')
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
        Schema::drop('kotas');
    }
}
