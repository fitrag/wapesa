<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{WaliKelas, User, Kelas};

class WaliKelasController extends Controller
{
    public function index(){
        
        // Cek guru yang belum menjadi wali kelas
        $sudahwali = WaliKelas::where('tp_id', \App\Models\Tp::whereStatus(1)->first()?->id)->select('user_id')->get()->pluck('user_id');
        $users = User::whereNotIn('id', $sudahwali)->where('level','guru')->whereIsWalas(1)->get();

        // Cek kelas yang belum ada wali kelas
        $belumWali = WaliKelas::where('tp_id', \App\Models\Tp::whereStatus(1)->first()?->id)->select('kelas_id')->get()->pluck('kelas_id');
        $kelass = Kelas::whereNotIn('id', $belumWali)->get();

        $wali_kelass = WaliKelas::with(['user','kelas'])->where('tp_id', \App\Models\Tp::whereStatus(1)->first()?->id)->get();
        return view('admin.wali-kelas.index', compact('wali_kelass','users','kelass'));
    }

    public function store(Request $req){
        $req->validate([
            'user_id'       => 'required',
            'kelas_id'       => 'required',
        ],[
            'user_id.required'      => 'Guru tidak boleh kosong',
            'kelas_id.required'      => 'Kelas tidak boleh kosong',
        ]);

        $insert = WaliKelas::create([
            'user_id'       => $req->user_id,
            'kelas_id'      => $req->kelas_id,
            'tp_id'         => \App\Models\Tp::whereStatus(1)->first()->id,
        ]);
        if($insert){
            return redirect()->route('admin.wali-kelas')->with('success', 'Berhasil menambahkan wali kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan wali kelas');
        }
    }
    public function destroy(WaliKelas $wali_kelas){
        $delete = $wali_kelas->delete();
        if($delete){
            return redirect()->route('admin.wali-kelas')->with('success', 'Berhasil menghapus wali kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus wali kelas');
        }
    }
}
