<?php

namespace App\Http\Controllers\Su_admin;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Requests\UpdatePasswordRequest;

class Profile_AdmController extends Controller
{
    public function edit()
    {
        $profil = User::select('id','name','email')->where('id', '=', Auth::user()->id)->first();
        // dd($profil);
        return view('manager.profil.profil', compact('profil'));
    }
    
    public function changePassword1(Request $request){

        if (!Hash::check($request->get('current-password'), Auth::user()->password)) {
            // The passwords matches
            return redirect()->back()->with("toast_error","Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silakan coba lagi.");
        }
        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("toast_error","Kata Sandi Baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi yang berbeda.");
        }

        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required',
            // 'current-password' => 'required',
            // 'new-password_confirmation' => 'required',
            // 'new-password' => 'string|min:6|same:new-password_confirmation',
        ]);

        if($request->get('new-password')==null){
            $profil = User::where('id', '=', Auth::user()->id)->first();
            $profil->name = $request->get('name');
            $profil->email = $request->get('email');
            $profil->save();
            }else{
            $validatedData = $request->validate([
                'email' => 'required',
                'name' => 'required',
                'current-password' => 'required',
                'new-password_confirmation' => 'required',
                'new-password' => 'string|min:6|same:new-password_confirmation',
            ]);
        //Change Profile
        $profil = User::where('id', '=', Auth::user()->id)->first();
        $profil->name = $request->get('name');
        $profil->email = $request->get('email');
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        
        $user->save();
        $profil->save();
        }
        return redirect()->back()->with("toast_success","Data berhasil di ubah!");

    }
}
