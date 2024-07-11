<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Prakerin, SiswaPrakerin};

class PrakerinController extends Controller
{
    public function index(){
        return view('admin.prakerin.index');
    }
    public function store(Request $req){
        $data = $req->validate([
            'nama'      => 'required',
            'telpon'   => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);
        $insert = Prakerin::create($data);
        if($insert){
            return redirect()->route('admin.prakerin')->with('success', 'Berhasil menambahkan data');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data');
        }

    }
    public function edit(Prakerin $prakerin){
        return view('admin.prakerin.edit', compact('prakerin'));
    }
    public function update(Request $req, Prakerin $prakerin){
        $data = $req->validate([
            'nama'      => 'required',
            'telpon'   => 'required',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);
        $update = $prakerin->update($data);
        if($update){
            return redirect()->route('admin.prakerin')->with('success', 'Data berhasil diperbarui');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data');;
        }
    }
    public function destroy(Prakerin $prakerin){
        $delete = $prakerin->delete();
        if($delete){
            return redirect()->route('admin.prakerin')->with('success', 'Data berhasil dihapus');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data');;
        }
    }


    public function tambahSiswa(Prakerin $prakerin){
        return view('admin.prakerin.tambah-siswa', compact('prakerin'));
    }
    public function siswaPrakerin(Request $req){
        $siswaprakerins = SiswaPrakerin::wherePrakerinId($req->id)->whereTpId(\App\Models\Tp::whereStatus(1)->first()?->id)->get();
        return view('admin.prakerin.siswa-prakerin-ajax', compact('siswaprakerins'));
    }
    public function tambahSiswaAjax(Request $req){
        $insert = SiswaPrakerin::create([
            'siswa_id'      => $req->siswa_id,
            'prakerin_id'   => $req->prakerin_id,
            'tp_id'         => $req->tp_id,
        ]);

        if($insert){
            $data = [];
            $data['status']     = 'Berhasil';
            $data['statusCode'] = 200;
            $data['message']    = 'Data berhasil ditambahkan';
            echo json_encode($data);
        }else{
            echo json_encode([
                'message' => 'Data gagal ditambahkan',
                'statusCode' => 500
            ]);
        }
    }
    public function siswaPrakerinHapusAjax(Request $req){
        $siswaprakerin = SiswaPrakerin::find($req->id);
        $delete = $siswaprakerin->delete();

        if($delete){
            $data = [];
            $data['status']     = 'Berhasil';
            $data['statusCode'] = 200;
            $data['message']    = 'Data berhasil dihapus';
            echo json_encode($data);
        }else{
            echo json_encode([
                'message' => 'Data gagal dihapus',
                'statusCode' => 500
            ]);
        }
    }
}
