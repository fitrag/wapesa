<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Siswa,User, WaliKelas, Jenisbayar, Tp, Prakerin, SiswaPrakerin};
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    public $tp; 

    public function __construct(){
        $this->tp = Tp::whereStatus(1)->first();
    }

    public function index(){
        $qrCode = QrCode::size(250)->generate('0011306181');
        return view('welcome', compact('qrCode'));
    }
    public function qrcode(){
        $qrCode = QrCode::size(80)->generate('0011306181');
        return view('qrcode', compact('qrCode'));
    }
    public function dashboard(){
        if($this->tp){
            $walikelass = WaliKelas::with('kelas','user')->whereTpId($this->tp->id)->get();
            $jenis_bayars = Jenisbayar::whereTpId($this->tp->id)->get();
        }else{
            $walikelass = [];
            $jenis_bayars = [];
        }
        return view('admin.dashboard', compact('walikelass','jenis_bayars'));
    }
    public function siswaAjax(){
        if(auth()->user()->level == 'admin'){
            $siswas = Siswa::all();
        }else if(auth()->user()->level == 'guru' AND auth()->user()->is_walas){
            $siswas = Siswa::whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }
        return DataTables::of($siswas)
            ->AddColumn('nis', function($data){
                return $data->nis;
            })
            ->AddColumn('nisn', function($data){
                return $data->nisn;
            })
            ->AddColumn('nama', function($data){
                return $data->nm_siswa;
            })
            ->AddColumn('kelas', function($data){
                return $data->kelas->nm_kls;
            })
            ->AddColumn('username', function($data){
                return $data->user->username;
            })
            ->AddColumn('action', function($data){
                return auth()->user()->level == 'admin' ? '<a href="'.route('admin.siswa.edit_siswa', ['siswa' => $data->id]).'" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                <a href="'.route('admin.siswa.qrcode', ['siswa' => $data->id]).'" class="btn btn-info m-1"><i class="fas fa-qrcode"></i></a>
                <a href="'.route('admin.siswa.delete-ajax', ['siswa' => $data->id]).'" onclick="return confirm(`Anda yakin ingin menghapus data ini?`)" class="btn btn-danger m-1"><i class="fas fa-trash"></i></a>'
                : '
                <a href="'.route('admin.siswa.qrcode', ['siswa' => $data->id]).'" class="btn btn-info m-1"><i class="fas fa-qrcode"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function siswaPrakerinAjax(){
        $siswaPrakerin = SiswaPrakerin::whereTpId($this->tp->id)->get()->pluck('siswa_id');
        if(auth()->user()->level == 'admin'){
            $siswas = Siswa::whereNotIn('id',$siswaPrakerin)->get();
        }else if(auth()->user()->level == 'guru' AND auth()->user()->is_walas){
            $siswas = Siswa::whereNotIn('id',$siswaPrakerin)->whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->get();
        }
        return DataTables::of($siswas)
            ->AddColumn('nis', function($data){
                return $data->nis;
            })
            ->AddColumn('nama', function($data){
                return $data->nm_siswa;
            })
            ->AddColumn('kelas', function($data){
                return $data->kelas->nm_kls;
            })
            ->AddColumn('action', function($data){
                return '
                <button type="button" onclick="tambahSiswa('.$data->id.')" class="btn btn-info m-1"><i class="fas fa-plus"></i></button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function userAjax(){
        $user = User::latest()->get();
        return DataTables::of($user)
        ->addColumn('nama', function($data){
            return $data->name;
        })
        ->addColumn('username', function($data){
            return $data->username;
        })
        ->addColumn('password', function($data){
            return $data->password;
        })
        ->addColumn('wali_kelas', function($data){
            return $data->is_walas ? 'Iya' : 'Tidak';
        })
        ->addColumn('level', function($data){
            return $data->level;
        })
        ->addColumn('action', function($data){
            return '
            <a href="'.route('admin.user.edit', ['user' => $data->id]).'" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
            <a href="'.route('admin.user.delete-ajax', ['user' => $data->id]).'" onclick="return confirm(`Anda yakin ingin menghapus data ini?`)" class="btn btn-danger m-1"><i class="fas fa-trash"></i></a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function prakerinAjax(){
        $prakerin = Prakerin::latest()->get();
        return DataTables::of($prakerin)
        ->addColumn('nama', function($data){
            return $data->nama;
        })
        ->addColumn('telepon', function($data){
            return $data->telpon;
        })
        ->addColumn('latitude', function($data){
            return $data->latitude;
        })
        ->addColumn('longitude', function($data){
            return $data->longitude;
        })
        ->addColumn('action', function($data){
            return '
            <a href="'.route('admin.prakerin.edit', ['prakerin' => $data->id]).'" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
            <a href="'.route('admin.prakerin.delete-ajax', ['prakerin' => $data->id]).'" onclick="return confirm(`Anda yakin ingin menghapus data ini?`)" class="btn btn-danger m-1"><i class="fas fa-trash"></i></a>
            <a href="'.route('admin.prakerin.tambah-siswa', ['prakerin' => $data->id]).'" class="btn btn-info m-1"><i class="fas fa-user-plus"></i></a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function sinkronAbsensi(){
        return view('admin.experiment.sinkron-absensi');
    }
}
