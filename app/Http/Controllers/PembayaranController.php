<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Siswa, Jenisbayar, Tp, Pembayaran};

class PembayaranController extends Controller
{
    public $tp; 

    public function __construct(){
        $this->tp = Tp::whereStatus(1)->first();
    }

    public function tambah(){
        return view('admin.pembayaran.add');
    }
    public function form(Siswa $siswa){
        $jenis_bayars = Jenisbayar::whereKelas($siswa->kelas->alias)->whereTpId($this->tp->id)->get();
        return view('admin.pembayaran.form', compact('siswa','jenis_bayars'));
    }
    public function store(Request $req){
        $siswa = Siswa::find($req->siswaId);
        $jenisBayars = Jenisbayar::whereIn('id', $req->idjenisbayar)->get();
        // dd($jenisBayars);
        for($i=0;$i<count($req->idjenisbayar);$i++){
            $bayar = Pembayaran::create([
                'siswa_id'      => $siswa->id,
                'jenisbayar_id' => $req->idjenisbayar[$i],
                'kelas_id'      => $siswa->kelas->id,
                'tp_id'         => $this->tp->id,
                'nis'           => $siswa->nis,
                'tgl'           => date('Y-m-d'),
                'potongan'      => 0,
                'total_bayar'   => $req->bayar[$i],
                'sisa_bayar'    => 0,
                'status'        => $jenisBayars[$i]->biaya==$req->bayar[$i] ? 'lunas' : 'belum lunas',
            ]);
        }
        return redirect()->back();
    }
}
