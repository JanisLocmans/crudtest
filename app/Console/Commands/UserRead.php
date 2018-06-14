<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Post;

class UserRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:read {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expected user:read !!Optional user:read {id?} to retrieve specific user!!';

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
        if($this->argument('id')){
            //if argument get distinct row
            $user = User::find($this->argument('id'));

            if($user) {
                $this->comment('| id : ' . $user->id . ' | name : ' . $user->name . ' | ' . ' has : ' . count($user->posts) . ' posts');
                $this->comment('------------User Posts----------');
                foreach($user->posts as $item) {
                   
                    $this->comment(' post title : ' . $item->title . ' post content : ' . $item->content);
                }
            } else {

                $this->comment('----------------------');

                $this->comment('user does not exist');

                $this->comment('----------------------');
                $users = User::get();

                foreach($users as $item){
                    $this->comment('| id: ' . $item->id . ' | name: ' . $item->name . ' | ' . ' has : ' . count($item->posts) . ' posts');
                }
            }
        } else {
            //List all users
            $users = User::get();

            foreach($users as $item){
                $this->comment('| id: ' . $item->id . ' | name: ' . $item->name . ' | ' . ' has : ' . count($item->posts) . ' posts');
            }
            $this->comment('to get specific user info: user:read [id]');
        }

    }
}
