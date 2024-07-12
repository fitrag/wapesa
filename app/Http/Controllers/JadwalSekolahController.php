<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Kelas, Mapel, JadwalSekolah};
use Carbon\Carbon;

class JadwalSekolahController extends Controller
{
    public function index(Request $req){
        $kelass = Kelas::orderBy('nm_kls','ASC')->get();
        if($req->kelas_id){
            $kelas = Kelas::with(['jadwal_sekolahs'])->find($req->kelas_id);
        }else{
            $kelas = null;
        }
        $mapels = Mapel::orderBy('nm_mapel','ASC')->get();
        return view('admin.jadwal-sekolah.index', compact('kelass','mapels','kelas'));
    }
    public function lihat(Request $req){
        return $req->all();
    }
    public function indexAjax(Request $req){
        $kelas = Kelas::with(['jadwal_sekolahs'])->find($req->kelas_id);
        return view('admin.jadwal-sekolah.ajax-jadwal-sekolah', compact('kelas'));
    }
    public function store(Request $req){
        $insert = JadwalSekolah::create($req->all());
        if($insert){
            $data = [];
            $data['status']     = 'Berhasil';
            $data['statusCode'] = 200;
            $data['message']    = 'Data berhasil ditambahkan';
            $data['kelas_id']   = $req->kelas_id;
            echo json_encode($data);
        }else{
            echo json_encode([
                'message' => 'Data gagal ditambahkan',
                'statusCode' => 500
            ]);
        }
    }
    public function update(Request $req){
        $jadwalSekolah = JadwalSekolah::find($req->id)->update([
            'hari'          => $req->hari,
            'updated_at'    => Carbon::now()
        ]);
    }
    public function destroy($id){
        $delete = JadwalSekolah::find($id)->delete();
        if($delete){
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data');;
        }
    }
}
