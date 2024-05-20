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
    public function update(Request $req, Pengaturan $pengaturan){
        $update = $pengaturan->update($req->all());
        if($update){
            return redirect()->route('pengaturan')->with('success', 'Berhasil menyimpan pengaturan');
        }else{
            return redirect()->back()->with('success', 'Gagal menyimpan pengaturan');
        }
    }
}
