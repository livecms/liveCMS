<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:admin {--email=admin} {--password=admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->option('email');
        if (null == User::where('email', $email)->first()) {
            User::create([
                'name' => 'Live CMS Administrator',
                'email' => $email,
                'password' => bcrypt($this->option('password')),
                // 'is_admin' => true,
            ]);
        }
    }
}
