<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
// use App\Requests\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $profil = User::select('id','name','username')->where('level', '=', 1)->first();
        // dd($profil);
        return view('profil.profil', compact('profil'));
    }
    
    public function changePassword(Request $request){
        // $qwe = Auth::user()->password;
        // dd($qwe);
        if (\Hash::check($request->get('current-password'), Auth::user()->password)) {
            // The passwords matches
            return redirect()->back()->with("toast_error","Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silakan coba lagi.");
        }
        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("toast_error","Kata Sandi Baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi yang berbeda.");
        }

        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'current-password' => 'required',
            'new-password' => 'string|min:6|confirmed',
        ]);
        //Change Profile
        $profil = User::where('id', '=', 1)->first();
        $profil->name = $request->get('username');
        $profil->username = $request->get('email');
        //Change Password
        $user = Auth::user();
        $user->password = (\Hash::make($request->get('new-password')));
        
        $user->save();
        $profil->save();

        return redirect()->back()->with("toast_success","Password changed successfully !");

    }
}
