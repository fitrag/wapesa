<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tp;

class TpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_pelajarans = Tp::all();
        return view('admin.tahun-pelajaran.index', compact('tahun_pelajarans'));
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
        $validate = $request->validate([
            'nm_tp'     => 'required',
            'status'    => 'required',
        ]);
        $insert = Tp::create($validate);
        if($insert){
            Tp::where('id','!=', $insert->id)->update(['status' => 0]);
            return redirect()->route('admin.tahun-pelajaran')->with('success','Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tp $tahun_pelajaran)
    {
        return view('admin.tahun-pelajaran.edit', compact('tahun_pelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tp $tahun_pelajaran)
    {
        $validate = $request->validate([
            'nm_tp'     => 'required',
            'status'    => 'required',
        ]);
        $update = $tahun_pelajaran->update($validate);
        if($update){
            Tp::where('id','!=', $tahun_pelajaran->id)->update(['status' => 0]);
            return redirect()->route('admin.tahun-pelajaran')->with('success','Berhasil memperbarui data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tp $tahun_pelajaran)
    {
        $delete = $tahun_pelajaran->delete();
        if($delete){
            return redirect()->route('admin.tahun-pelajaran')->with('success','Berhasil menghapus data');
        }
    }
}
