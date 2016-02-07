<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('no_hp', 12);
            $table->text('alamat');
            $table->integer('propinsi_id')->unsigned()->nullable();
            $table->integer('kota_id')->unsigned()->nullable();
            $table->integer('kecamatan_id')->unsigned()->nullable();
            $table->integer('kelurahan_id')->unsigned()->nullable();
            $table->string('kodepos', 5);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('propinsi_id')->references('id')->on('propinsis')->onDelete('set null');
            $table->foreign('kota_id')->references('id')->on('kotas')->onDelete('set null');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
