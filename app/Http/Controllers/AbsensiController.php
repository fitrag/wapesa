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
        if($siswa){
            $tanggal = Absensi::whereSiswaId($siswa->id)->first();
            if($tanggal AND date_format(date_create($tanggal->created_at),'Y-m-d') == date('Y-m-d')){
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
                'message' => 'Tidak ditemukan',
                'statusCode' => 404
            ]);
        }
    }

}
