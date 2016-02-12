<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SetupSeeder::class);
        $this->call(DefaultRoleSeeder::class);
        $this->call(DefaultSuperAdminUserSeeder::class);
        $this->call(DefaultAdminUserSeeder::class);
    }
}
