<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
            'password' => $request->password,
        ];
    
        if (Auth::attempt($login)) {
            $user = Auth::user();
            $roleName = $user->role->name;
    
            Cookie::queue('username', $user->username, 480);
    
            Alert::toast('Login successful!', 'success', ['timer' => 1500]);
    
            if ($roleName == 'admin') {
                return redirect()->intended('/admin-dashboard');
            } elseif ($roleName == 'staff') {
                return redirect()->intended('/staff-dashboard');
            }
        } else {
            Alert::toast('Login failed!', 'error', ['timer' => 3000]);
            return redirect('/login')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
