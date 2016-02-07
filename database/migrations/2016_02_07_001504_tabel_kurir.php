<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelKurir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurirs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode', 20);
            $table->string('kurir', 50);
            $table->string('logo');
            $table->string('alamat');
            $table->string('nama_kontak');
            $table->string('no_kontak');
            $table->string('catatan');
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
        Schema::drop('kurirs');
    }
}
