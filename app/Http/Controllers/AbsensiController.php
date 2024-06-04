<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Siswa, Absensi, Tp, Kelas};

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
        }else{
            echo json_encode([
                'message' => 'Data tidak ditemukan, silahkan hubungi administrator',
                'statusCode' => 404
            ]);
        }
    }

    public function tambah(Request $req){
        $kelass = Kelas::all();

        if($req->kelas_id){
            $sudahAbsen = Absensi::whereKelasId($req->kelas_id)->whereDate('created_at', date('Y-m-d'))->get()->pluck('siswa_id');
            if($sudahAbsen->count() != Siswa::whereKelasId($req->kelas_id)->count()){
                $siswas = Siswa::with('absensis')->whereNotIn('id',$sudahAbsen)->whereKelasId($req->kelas_id)->get();
            }else{
                $siswas = Siswa::with('absensis')->whereKelasId($req->kelas_id)->get();
            }
            return view('admin.absensi.tambah', compact('kelass','siswas'));
        }else{
            $siswas = [];
            return view('admin.absensi.tambah', compact('kelass','siswas'));
        }
    }

    public function store(Request $req){
        $tp = Tp::where('status',1)->first();

        $req->validate([
            'hadir'     => 'array',
            'hadir.*'   => 'required'
        ]);

        for($i=0;$i<count($req->user_id);$i++){

            $insert = Absensi::updateOrCreate([
                'nis'   => $req->nis[$i]
            ],[
                'nis'           => $req->nis[$i],
                'user_id'       => $req->user_id[$i],
                'kelas_id'      => $req->kelas_id,
                'tp_id'         => $tp->id,
                'siswa_id'      => $req->siswa_id[$i],
                'semester'      => $tp->semester,
                'hadir'         => $req->hadir[$i],
            ]);

        }
        if($insert){
            return redirect()->route('absensi-tambah')->with('success', 'Berhasil menambahkan data');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data');
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
            $siswas = Siswa::with(['absensis' => function($query) use($req){
                $query->whereDate('created_at', date('Y-m-d'));
            }])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }
        return view('admin.absensi.absen-harian', compact('absensis','siswas'));
    }

    // Lihat absensi bulanan untuk wali kelas
    public function bulanan(Request $req){
        // $absensis = Absensi::whereMonth('created_at', date('m'))->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();   
        if($req->bulan){

            $data = explode('-', $req->bulan);
            $year = $data[0];
            $month = $data[1];

            $siswas = Siswa::with(['absensis' => function($query) use($month, $year){
                $query->whereMonth('created_at', $month);
                $query->whereYear('created_at', $year);
                $query->orderBy('created_at');
            }])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();

        }else{
            $siswas = Siswa::with(['absensis' => function($query){
                $query->whereMonth('created_at', date('m'));
                $query->whereYear('created_at', date('Y'));
                $query->orderBy('created_at');
            }])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }
        return view('admin.absensi.absen-bulanan', compact('siswas'));
    }

    // Lihat absensi per tahun pelajaran untuk wali kelas
    public function tahunPelajaran(){
        $tp = Tp::where('status',1)->first();
        $siswas = Siswa::with(['absensis'])->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        return view('admin.absensi.absen-tahun-pelajaran', compact('siswas','tp'));
    }

}
