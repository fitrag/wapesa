<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Guru_ajar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $tp = Tp::all();
        return view('admin.guru-ajar.index_guruajar_tp', compact('tp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function tampil_ajar_tp($tp_id)
    {
        $guru_ajar = Guru_ajar::select('guru_id')->groupBy('guru_id')->get();
        $guru = Guru::all();
        return view('admin.guru-ajar.index_guruajar', compact('guru_ajar','guru','tp_id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'mapel_id'         => 'required',
        ]);

        $guru_ajar = Guru_ajar::create($request->all());
        if($guru_ajar){
            return redirect()->back()->with('success', 'Berhasil menambahkan data kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($guru_ajar)
    {
        $mapel = Guru_ajar::select('guru_ajars.id','guru_ajars.mapel_id','mapels.nm_mapel')
                                ->join('mapels','guru_ajars.mapel_id','mapels.id')
                                ->where('guru_ajars.guru_id', $guru_ajar)
                                ->get();
        $guru = Guru::select('nm_guru','id')
                                ->where('id', $guru_ajar)
                                ->first();  
        $mapels = Mapel::all();            
        return view('admin.guru-ajar.tampil_guruajar', compact('mapel','guru','mapels'));
    }

    public function tampil($id, $tp_id)
    {
        $mapel = Guru_ajar::select('guru_ajars.id','guru_ajars.mapel_id','mapels.nm_mapel','tps.nm_tp','kelas.nm_kls')
                                ->join('mapels','guru_ajars.mapel_id','mapels.id')
                                ->join('tps','guru_ajars.tp_id','tps.id')
                                ->join('kelas','guru_ajars.kelas_id','kelas.id')
                                ->where('guru_ajars.guru_id', $id)
                                ->get();
        $guru = Guru::select('nm_guru','id')
                                ->where('id', $id)
                                ->first();  
        $mapels = Mapel::all();    
        $tp = Tp::all();        
        $kelas = Kelas::orderBy('nm_kls')->get();        
        return view('admin.guru-ajar.tampil_guruajar', compact('mapel','guru','mapels','tp','kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru_ajar $guru_ajar)
    {
        $delete = $guru_ajar->delete();
        if($delete){
            return redirect()->route('admin.guru-ajar')->with('success', 'Berhasil menghapus data');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data');
        }
    }
}
