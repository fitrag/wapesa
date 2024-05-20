<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;

class PengaturanController extends Controller
{
    public function index(){
        $pengaturan = Pengaturan::find(1);
        return view('admin.pengaturan', compact('pengaturan'));
    }
    public function update(Request $req, $id){
        if($req->hasFile('logo')){
            $update = Pengaturan::updateOrCreate([
                'id' => $id,
            ],[
                'nama_aplikasi'         => $req->nama_aplikasi,
                'nama_sekolah'          => $req->nama_sekolah,
                'npsn'                  => $req->npsn,
                'alamat_sekolah'        => $req->alamat_sekolah,
                'logo'                  => $req->logo->getClientOriginalName(),
            ]);
            $req->file('logo')->move('img/',$req->logo->getClientOriginalName());
        }else{
            $update = Pengaturan::updateOrCreate([
                'id' => $id,
            ],[
                'nama_aplikasi'         => $req->nama_aplikasi,
                'nama_sekolah'          => $req->nama_sekolah,
                'npsn'                  => $req->npsn,
                'alamat_sekolah'        => $req->alamat_sekolah,
            ]);
        }
        if($update){
            return redirect()->route('pengaturan')->with('success', 'Berhasil menyimpan pengaturan');
        }else{
            return redirect()->back()->with('success', 'Gagal menyimpan pengaturan');
        }
    }
}
