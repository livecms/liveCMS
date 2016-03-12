<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleOfSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_users', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('user_id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
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
        Schema::table('role_users', function ($table) {
            $table->dropForeign('role_users_site_id_foreign');
            $table->dropColumn('site_id');
        });
    }
}
