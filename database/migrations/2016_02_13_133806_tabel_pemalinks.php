<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPemalinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permalinks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permalink')->unique();
            $table->integer('postable_id')->unsigned();
            $table->string('postable_type');
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
        Schema::drop('permalinks');
    }
}
