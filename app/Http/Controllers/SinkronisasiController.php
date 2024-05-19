<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Http;

class SinkronisasiController extends Controller
{
    public function sinkronAbsensi(){
        $absensis = Absensi::select(['id','nis','kelas_id','tp_id','siswa_id','semester','hadir','ket','username'])->whereDay('created_at', now()->day)->get();
        $request = Http::post('https://fb9b-103-59-44-219.ngrok-free.app/api/sinkron-absensi',[
            'key'   => 'sim_wapesa-ABCD',
            'data' => $absensis
        ]);

        return $request;
    }
}
