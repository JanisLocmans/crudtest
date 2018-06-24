<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('test');
});

//all note routesc
Route::group(['prefix' => 'api'], function() {
    Route::resource('notes', 'PostController');
    Route::resource('users', 'UserController');

    Route::get('/user/verify/{verification_code}', 'AuthController@verifyUser');

    Route::post('register', 'AuthController@register');
    Route::post('requesttoken', 'AuthController@requestToken');
    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::get('test', function(){
            return response()->json(['Success']);
        });
    });
});





