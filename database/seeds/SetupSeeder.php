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
        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'Live CMS'],
            ['key' => 'slug_admin', 'value' => '@'],
            ['key' => 'slug_article', 'value' => 'a'],
            ['key' => 'slug_staticpage', 'value' => 'p'],
        ]);
    }
}
