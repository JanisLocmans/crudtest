<?php

namespace App\Http\Controllers;
use App\Events\RegisterEvent;
use Illuminate\Http\Request;
use App\Http\Requests\login;
use App\Http\Requests\register;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Libraries\AuthHandlerClass;

class AuthController extends Controller
{
    protected $authHandlerClass;
    function __construct(AuthHandlerClass $authHandlerClass){
        $this->AuthHandlerClass = $authHandlerClass;
    }
    public function register(register $request)
    {

        $user = $this->AuthHandlerClass->newuser($request);

        event(new RegisterEvent($user));

        return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
    }

    public function verifyUser($verification_code)
    {
        return $this->AuthHandlerClass->verify($verification_code);
    }

    public function login(login $request)
    {
        return $this->AuthHandlerClass->login($request->only('email', 'password'));
    }

}
