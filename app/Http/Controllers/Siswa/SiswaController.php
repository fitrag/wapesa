<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa, Absensi, Pembayaran, Tp};

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

    public function scan(){
        return view('siswa.absensi.scan');
    }
    public function scanning(Request $req){
        
        $lat2 = auth()->user()->siswa->siswaprakerin?->prakerin->latitude;
        $lon2 = auth()->user()->siswa->siswaprakerin?->prakerin->longitude;
        $lat1 = $req->latitude;
        $lon1 = $req->longitude;
        
        $earthRadius = 6371000;
        
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        // calculate the change in coordinates
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        // Haversine formula to calculate distance between two points
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // calculate the distance
        $meters = $earthRadius * $c;
        
        $siswa = Siswa::with('kelas')->whereNis($req->siswa)->first();
        if($siswa AND $siswa->user->is_active){
            if(!$siswa->siswaprakerin){
                echo json_encode([
                    'message' => 'Gagal absen, anda belum terdaftar sebagai siswa yang sedang prakerin',
                    'statusCode' => 500
                ]);
            }else{
                if(intval(\App\Models\Pengaturan::find(1)->radius == 0 ? 1000 : \App\Models\Pengaturan::find(1)->radius) < intval(round($meters,0))){
                    echo json_encode([
                        'message' => 'Gagal absen, anda berada diluar radius',
                        'statusCode' => 500,
                        'jarak' => round($meters,0)
                    ]);
                }else{
                    $tanggal = Absensi::whereSiswaId($siswa->id)->latest()->first();
                    if($tanggal AND date_format(date_create($tanggal->created_at),'Y-m-d') === date('Y-m-d')){
                        echo json_encode([
                            'message' => 'Sudah absen',
                            'statusCode' => 500
                        ]);
                    }else{
                        if($siswa){
                            $tp = Tp::where('status',1)->first();
                            $absensi = Absensi::create([
                                'nis'       => $siswa->nis,
                                'kelas_id'  => $siswa->kelas->id,
                                'tp_id'     => $tp->id,
                                'siswa_id'  => $siswa->id,
                                'user_id'   => $siswa->user->id,
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
                }
            }
        }else{
            echo json_encode([
                'message' => 'Data tidak ditemukan, silahkan hubungi administrator',
                'statusCode' => 404
            ]);
        }
    } 

    public function pembayaran(){
        return view('siswa.pembayaran.index');
    }
    public function detailPembayaran($id){
        $pembayaran = Pembayaran::with(['jenisbayar','siswa'])->find($id);
        return view('siswa.pembayaran.detail', compact('pembayaran'));
    }
}
