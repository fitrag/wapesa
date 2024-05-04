<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Hash};


class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('name','ASC')->get();
        return view('admin.user.index', compact('users'));
    }
    public function store(Request $req){
        $req->validate([
            'username'  => 'required',
            'password'  => 'required',
            'level'     => 'required',
            'is_walas'  => 'required',
        ]);

        $user = User::create([
            'name'      => $req->username,
            'username'  => $req->username,
            'level'     => $req->level,
            'is_walas'  => $req->is_walas,
            'password'  => Hash::make($req->password),
        ]);

        if($user){
            return redirect()->route('data-user');
        }else{
            return redirect()->back();
        }
    }
}
