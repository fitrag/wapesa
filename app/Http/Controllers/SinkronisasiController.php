<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Http;

class SinkronisasiController extends Controller
{
    public function sinkronAbsensi(){
        $absensis = Absensi::select(['id','nis','kelas_id','tp_id','siswa_id','semester','hadir','ket','username'])->whereDay('created_at', now()->day)->get();
        $request = Http::post('http://127.0.0.1/api/sinkron-absensi',[
            'key'   => 'sim_wapesa-ABCD',
            'data' => $absensis
        ]);
        if($request){
            return $request;
        }else{
            return json_encode([
                'statusCode'    => 500,
                'message'       => 'Gagal mengambil data'
            ]);
        }

    }
}
