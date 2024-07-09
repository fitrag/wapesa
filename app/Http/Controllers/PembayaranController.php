<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Siswa, Jenisbayar, Tp, Pembayaran, Riwayatbayar};

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
                'potongan'      => $req->potongan[$i],
                'sisa_bayar'    => $jenisBayars[$i]->biaya-($req->bayar[$i]+$req->potongan[$i]),
                'status'        => $jenisBayars[$i]->biaya==$req->bayar[$i]+$req->potongan[$i] ? 'lunas' : 'belum lunas',
            ]);

            if($req->bayar[$i] > 0){
                Riwayatbayar::create([
                    'pembayaran_id'     => $bayar->id,
                    'tgl'               => date('Y-m-d'),
                    'jumlah_bayar'      => $req->bayar[$i]
                ]);
            }
        }
        return redirect()->back()->with('cetak',route('pembayaran-cetak', ['id' => $req->siswaId, 'bayar' => $req->uangBayar]));

    }
    public function edit(Request $req){
        $jenisBayars = Jenisbayar::whereIn('id', $req->idjenisbayar)->get();
        for($i=0;$i<count($req->idpembayaran);$i++){
            $pembayaran                 = Pembayaran::find($req->idpembayaran[$i]);
            $pembayaran->total_bayar    = $pembayaran->total_bayar + $req->bayar[$i];
            $pembayaran->potongan       = $pembayaran->potongan+$req->potongan[$i];
            $pembayaran->sisa_bayar     = $pembayaran->sisa_bayar-($req->bayar[$i]+$req->potongan[$i]);
            $pembayaran->status         = ($jenisBayars[$i]->biaya == $pembayaran->total_bayar+$pembayaran->potongan) ? 'lunas' : 'belum lunas';
            $pembayaran->save();

            if($req->bayar[$i] > 0){
                Riwayatbayar::create([
                    'pembayaran_id'     => $req->idpembayaran[$i],
                    'tgl'               => date('Y-m-d'),
                    'jumlah_bayar'      => $req->bayar[$i]
                ]);
            }

        }
        // dd($pembayaran);
        return redirect()->back()->with('cetak',route('pembayaran-cetak', ['id' => $req->siswaId, 'bayar' => $req->uangBayar]));
    }

    public function cetak($id, $bayar){
        $siswa = Siswa::with(['pembayarans' => function($query){
            $query->whereDate('updated_at', date('Y-m-d'));
            $query->where('total_bayar','!=', 0);
        }])->find($id);
        return view('admin.pembayaran.cetak', compact('siswa','bayar'));
    }
}
 