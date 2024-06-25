<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Guru_ajar;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru_ajar = Guru_ajar::select('guru_id')->groupBy('guru_id')->get();
        $guru = Guru::all();
           
        return view('admin.guru-ajar.index_guruajar', compact('guru'));
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
    public function store(Request $request)
    {
        $request->validate([
            'mapel_id'         => 'required',
        ]);

        $guru_ajar = Guru_ajar::create($request->all());
        if($guru_ajar){
            return redirect()->route('admin.guru-ajar')->with('success', 'Berhasil menambahkan data kelas');
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
