<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expected user:create {name}';

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
            $user_exist = User::where('name', $this->argument('name'))->first();            
            if($user_exist != null) {
                $this->comment('username exists');
            } else {
                $user = new User;
                $user->name = $this->argument('name');
                $user->save();
                $this->comment('user: ' . $this->argument('name') . ' has been added');
            }
    }
}
