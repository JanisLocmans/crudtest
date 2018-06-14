<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UserUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update {id} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expected user:update {id} {name}';

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
                $user_exist->name = $this->argument('name');
                $user_exist->save();
                $this->comment('user :'. $user_exist->id . ' ' . $user_exist->name . ' updated. New name: ' . $this->argument('name')); 
            }  else {
                $this->comment('doesnt exists');               
            }
    }
}
