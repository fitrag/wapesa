<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa, Absensi, Pembayaran};

class SiswaController extends Controller
{
    public function index(){
        $absensis = Absensi::with(['siswa'])->whereSiswaId(auth()->user()->siswa->id)->latest()->limit(5)->get();
        return view('siswa.dashboard', compact('absensis'));
    }
    public function absensi(Request $req){
        if($req->bulan){
            $data = explode('-', $req->bulan);
            $year = $data[0];
            $month = $data[1];

            $siswas = Siswa::with(['absensis' => function($query) use($month, $year){
                $query->whereMonth('created_at', $month);
                $query->whereYear('created_at', $year);
                $query->orderBy('created_at');
            }])->whereKelasId(auth()->user()->siswa->kelas_id)->whereId(auth()->user()->siswa->id)->get();

        }else{
            $siswas = Siswa::with(['absensis' => function($query){
                $query->whereMonth('created_at', date('m'));
                $query->whereYear('created_at', date('Y'));
                $query->orderBy('created_at');
            }])->whereKelasId(auth()->user()->siswa->kelas_id)->whereId(auth()->user()->siswa->id)->get();
        }

        return view('siswa.absensi.index', compact('siswas'));
    }

    public function pembayaran(){
        return view('siswa.pembayaran.index');
    }
    public function detailPembayaran($id){
        $pembayaran = Pembayaran::with(['jenisbayar','siswa'])->find($id);
        return view('siswa.pembayaran.detail', compact('pembayaran'));
    }
}
