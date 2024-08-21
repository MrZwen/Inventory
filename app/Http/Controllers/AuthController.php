<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // dd($login);

        if (Auth::attempt($login)) {
            $user = Auth::user();
            $roleName = $user->role->name;
    
            if ($roleName == 'admin') {
                Alert::toast('Login successful!', 'success', ['timer' => 1500]);
                return redirect('/admin-dashboard');
            } 
            else if ($roleName == 'staff') {
                Alert::toast('Login successful!', 'success', ['timer' => 3000]);
                return redirect('/staff-dashboard');
            }
        } else {
            Alert::toast('Login failed!', 'error', ['timer' => 3000]);
            return redirect('/login');
        }

        // if(Auth::attempt($login)){
        //     if(Auth::user()->name == 1){
        //         return redirect('/admin-dashboard');
        //     } else if(Auth::user()->role_id == 2){
        //         return redirect('/staff-dashboard');
        //     }
        // } else {
        //     return redirect('/login')->with('error', 'Invalid credentials');
        // }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
