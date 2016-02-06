<?php

use Illuminate\Database\Seeder;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['admin', 'banned', 'author'] as $role) {
            if (DB::table('roles')->where(compact('role'))->get()) {
                continue;
            }
            
            DB::table('roles')->insert(compact('role'));
        }
    }
}
