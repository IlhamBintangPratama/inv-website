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

        if($request->email != null){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 1])){
                return redirect('/dashboard_admin');
            }
            elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 2])){
                return redirect('/home');
            }
            elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level' => 3])){
                return redirect('/dashboard');
            }
            return redirect('/')->with('toast_error', 'username dan password salah');
        }else{
            return redirect('/')->with('toast_error', 'Silahkan masukan username dan password');
        }
        
    }

    public function logout (Request $request){
        Auth::logout();
        return redirect('/');
    }
}
