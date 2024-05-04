<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Hash, Auth};

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function auth(Request $req){
        $credentials = $req->validate([
            'username'      => 'required',
            'password'      => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Akun tidak ditemukan, silahkan hubungi administrator');
    }
    public function register(){
        return view('auth.register');
    }
    public function store(Request $req){
        $req->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $user = User::create([
            'name'      => $req->username,
            'username'  => $req->username,
            'password'  => Hash::make($req->password),
        ]);

        if($user){
            return redirect()->route('login');
        }else{
            return redirect()->back();
        }
    }
    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
