<?php

use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        DB::table('settings')->insert([
            ['publicable' => true,'key' => 'site_name', 'value' => 'Live CMS'],
            ['publicable' => true,'key' => 'site_initial', 'value' => 'LC'],
            ['publicable' => true,'key' => 'slug_admin', 'value' => '@'],
            ['publicable' => true,'key' => 'slug_article', 'value' => 'a'],
            ['publicable' => true,'key' => 'slug_staticpage', 'value' => 'p'],
        ]);
    }
}
