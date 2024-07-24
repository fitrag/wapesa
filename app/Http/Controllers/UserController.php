<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Hash};
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('name', 'ASC')->get();
        return view('admin.user.index', compact('users'));
    }
    public function store(Request $req){
        $req->validate([
            'username'      => 'required',
            'password'      => 'required',
            'level'         => 'required',
            'is_walas'      => 'required',
            'is_gurupiket'  => 'required',
        ]);

        $user = User::create([
            'name'          => $req->name,
            'username'      => $req->username,
            'is_walas'      => $req->is_walas,
            'is_guru_piket' => $req->is_guru_piket,
            'level'         => $req->level,
            'password'      => Hash::make($req->password),
        ]);

        if($user){
            return redirect()->route('admin.user')->with('success', 'Berhasil menambahkan data');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data');
        }
    }
    public function edit(User $user){
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $req, User $user){
        $update = $user->update($req->all());
        if($update){
            return redirect()->route('admin.user')->with('success', 'Berhasil memperbarui data');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data');
        }
    }
    public function destroy(User $user){
        $delete = $user->delete();
        if($delete){
            return redirect()->route('admin.user')->with('success', 'Data berhasil dihapus');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data');;
        }
    }

    public function profile(User $user){
        return view('admin.user.profile', compact('user'));
    }

    public function profileUpdate(Request $req, User $user){

        $req->validate([
            'name'  => 'required',
            'foto'  => 'max:1000'
        ],[
            'foto.max' => 'Ukuran file foto melebihi 1MB'
        ]);

        if($req->hasFile('foto')){

            File::delete('foto/'.auth()->user()->foto);

            $update = $user->update([
                'foto'  => $req->foto->getClientOriginalName(),
                'name'  => $req->name
            ]);
        }else{
            $update = $user->update([
                'name'  => $req->name
            ]);
        }


        if($update){
            if(auth()->user()->level == 'siswa'){
                $user->siswa()->update([
                    'nm_siswa'  => $req->name
                ]);
            }
            $req->file('foto')->move('foto/',$req->foto->getClientOriginalName());
            return redirect()->back()->with('success','Berhasil memperbarui profile');
        }
    }
}
