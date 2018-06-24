<?php

namespace App\Listeners;

use Mail;
use App\Events\RegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Verify;

class UserRegistered implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegisterEvent  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {

        //var_dump($event->user->email . $event->user->name . $event->user->id);

        $data = array(
            'email' => $event->user->email,
            'name' =>  $event->user->name,
            'id' =>  $event->user->id,
            'code' => $verification_code = str_random(30),
            'subject' => "Please verify your email address.");

        Verify::insert(['user_id'=>$data['id'],'token'=>$data['code']]);

        Mail::send('email.verify', ['name' => $data['name'], 'verification_code' => $data['code']],
            function($mail) use ($data){
                $mail->from('info@crudtest.com');
                $mail->to($data['email'], $data['name']);
                $mail->subject($data['subject']);
            });
    }
}
