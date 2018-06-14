<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UserDestroy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:destroy {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expected user:destroy {id}';

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
        $user_exist = User::find($this->argument('id'));            
            if($user_exist != null) {
                User::destroy($this->argument('id'));
                $this->comment('user :'. $user_exist->id . ' ' . $user_exist->name . ' deleted'); 
            }  else {
                $this->comment('doesnt exists');               
            }
    }
}
