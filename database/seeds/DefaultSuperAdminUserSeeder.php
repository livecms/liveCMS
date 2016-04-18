<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DefaultSuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('username', 'super')->get()) {
            return;
        }
        
        DB::table('users')->insert($user = [
                'username' => 'super',
                'email' => 'super@livecms.org',
                'password' => bcrypt('admin'),
                'name' => 'Super Administrator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        $user_id = DB::table('users')->where($user)->first()->id;

        $role_id = DB::table('roles')->where('role', 'super')->first()->id;

        DB::table('role_users')->insert(compact('role_id', 'user_id'));
    }
}
