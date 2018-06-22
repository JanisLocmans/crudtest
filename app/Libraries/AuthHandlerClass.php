<?php


namespace App\Libraries;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use App\Verify;
use Validator, DB, Hash, Mail;


class AuthHandlerClass
{
    private $verify;
    private $user;
    function __construct(Verify $verify, User $user) {
        $this->user = $user;
        $this->verify = $verify;
    }

    public function newuser($data) {
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];

    return $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
    }


    public function verify($data) {
        $check = $this->verify->where('token',$data)->first();
        if(!is_null($check)){
            $user = $this->user->find($check->user_id);
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }
            $user->update(['is_verified' => 1]);
            $this->verify->where('token',$data)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }

    public function login($data) {

        $data['is_verified'] = 1;

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($data)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);

    }
}
