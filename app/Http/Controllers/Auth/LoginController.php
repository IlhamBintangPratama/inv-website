<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function logUser (Request $request){

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level' => 1])){
            return redirect('/dashboard');
        }
        elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level' => 2])){
            return redirect('/home');
        }
        elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level' => 3])){
            return redirect('/m-dashboard');
        }
        return redirect('/')->with('message', 'Username dan Password salah');
    }

    public function logout (Request $request){
        Auth::logout();
        return redirect('/');
    }
}
