<?php

namespace App\Http\Controllers;
//Events
use App\Events\RegisterEvent;
//Requests
use App\Http\Requests\Login;
use App\Http\Requests\Register;
//Libraries
use App\Libraries\AuthHandlerClass;


//use Illuminate\Http\Request; // Using custom requests

class AuthController extends Controller
{
    protected $authHandlerClass;
    function __construct(AuthHandlerClass $authHandlerClass){
        $this->AuthHandlerClass = $authHandlerClass;
    }
    public function register(Register $request)
    {
        event(new RegisterEvent($this->AuthHandlerClass->newuser($request)));

        return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
    }

    public function verifyUser($verification_code)
    {
        return $this->AuthHandlerClass->verify($verification_code);
    }

    public function requestToken(Login $request)
    {
        return $this->AuthHandlerClass->requestToken($request->only('email', 'password'));
    }

}
