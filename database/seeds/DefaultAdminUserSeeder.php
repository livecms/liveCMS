
<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DefaultAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('username', 'admin')->get()) {
            return;
        }
        
        DB::table('users')->insert($user = [
                'username' => 'admin',
                'email' => 'admin@livecms.org',
                'password' => bcrypt('admin'),
                'name' => 'LiveCMS Administrator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        $user_id = DB::table('users')->where($user)->first()->id;

        $role_id = DB::table('roles')->where('role', 'admin')->first()->id;

        DB::table('role_users')->insert(compact('role_id', 'user_id'));
    }
}
