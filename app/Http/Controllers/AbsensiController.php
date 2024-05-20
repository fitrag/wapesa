<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Siswa, Absensi, Tp};

class AbsensiController extends Controller
{
    public function scan(){
        return view('admin.absensi.scan');
    }

    public function scanning(Request $req){
        $siswa = Siswa::with('kelas')->whereNis($req->siswa)->first();
        if($siswa AND $siswa->user->is_active){
            $tanggal = Absensi::whereSiswaId($siswa->id)->latest()->first();
            if($tanggal AND date_format(date_create($tanggal->created_at),'Y-m-d') === date('Y-m-d')){
                echo json_encode([
                    'message' => 'Sudah absen',
                    'statusCOde' => 500
                ]);
            }else{
                if($siswa){
                    $tp = Tp::where('status',1)->first();
                    $absensi = Absensi::create([
                        'nis'       => $siswa->nis,
                        'kelas_id'  => $siswa->kelas->id,
                        'tp_id'     => $tp->id,
                        'siswa_id'  => $siswa->id,
                        'semester'  => $tp->semester,
                        'hadir'     => 'h',
                    ]);

                    if($absensi){
                        $data = [];
                        $data['status']     = 'Berhasil';
                        $data['statusCode'] = 200;
                        $data['message']    = 'Data ditemukan';
                        $data['data']       = $siswa;
                        echo json_encode($data);
                    }
                }else{
                    echo json_encode([
                        'message' => 'Tidak ditemukan',
                        'statusCode' => 404
                    ]);
                }
            }
        }else{
            echo json_encode([
                'message' => 'Data tidak ditemukan, silahkan hubungi administrator',
                'statusCode' => 404
            ]);
        }
    }

    // Lihat absensi harian untuk wali kelas
    public function harian(Request $req){
        if($req->tanggal){
            $absensis = Absensi::with(['kelas'])->whereDate('created_at', $req->tanggal)->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
            $siswas = Siswa::with(['absensis' => function($query) use($req){
                $query->whereDate('created_at', $req->tanggal);
            }])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }else{
            $absensis = Absensi::with(['kelas'])->whereDate('created_at', date('Y-m-d'))->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
            $siswas = Siswa::with(['absensis'])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }
        return view('admin.absensi.harian', compact('absensis','siswas'));
    }

}
