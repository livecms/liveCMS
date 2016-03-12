<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameOfSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategoris', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::table('tags', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::table('artikels', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::table('static_pages', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::table('permalinks', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

            $table->foreign('site_id')
                  ->references('id')->on('sites')
                  ->onDelete('cascade');
        });

        Schema::table('settings', function ($table) {
            $table->integer('site_id')->unsigned()->nullable()->after('id');

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
        Schema::table('kategoris', function ($table) {
            $table->dropForeign('kategoris_site_id_foreign');
            $table->dropColumn('site_id');
        });

        Schema::table('tags', function ($table) {
            $table->dropForeign('tags_site_id_foreign');
            $table->dropColumn('site_id');
        });

        Schema::table('artikels', function ($table) {
            $table->dropForeign('artikels_site_id_foreign');
            $table->dropColumn('site_id');
        });

        Schema::table('static_pages', function ($table) {
            $table->dropForeign('static_pages_site_id_foreign');
            $table->dropColumn('site_id');
        });

        Schema::table('permalinks', function ($table) {
            $table->dropForeign('permalinks_site_id_foreign');
            $table->dropColumn('site_id');
        });

        Schema::table('settings', function ($table) {
            $table->dropForeign('settings_site_id_foreign');
            $table->dropColumn('site_id');
        });
    }
}
