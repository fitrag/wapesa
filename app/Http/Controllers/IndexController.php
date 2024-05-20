<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Siswa,User};
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    public function index(){
        $qrCode = QrCode::size(250)->generate('0011306181');
        return view('welcome', compact('qrCode'));
    }
    public function qrcode(){
        $qrCode = QrCode::size(80)->generate('0011306181');
        return view('qrcode', compact('qrCode'));
    }
    public function dashboard(){
        return view('admin.dashboard');
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
                return '<a href="'.route('admin.siswa.edit_siswa', ['siswa' => $data->id]).'" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                <a href="'.route('admin.siswa.qrcode', ['siswa' => $data->id]).'" class="btn btn-info m-1"><i class="fas fa-qrcode"></i></a>
                <a href="'.route('admin.siswa.delete-ajax', ['siswa' => $data->id]).'" onclick="return confirm(`Anda yakin ingin menghapus data ini?`)" class="btn btn-danger m-1"><i class="fas fa-trash"></i></a>';
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

    public function sinkronAbsensi(){
        return view('admin.experiment.sinkron-absensi');
    }
}
