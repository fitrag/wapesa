<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::orderBy('nm_mapel')->get();
        return view('admin.mapel.index_mapel', compact('mapel'));
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
            'nm_mapel'      => 'required',
            'alias'         => 'required',
        ]);

        $mapel = Mapel::create($request->all());
        if($mapel){
            return redirect()->route('mapel.index')->with('success', 'Berhasil menambahkan data mapel');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data mapel');
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
    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit_mapel', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $update = $mapel->update($request->all());
        if($update){
            return redirect()->route('mapel.index')->with('success', 'Berhasil memperbarui data mapel');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data mapel');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $delete = $mapel->delete();
        if($delete){
            return redirect()->route('mapel.index')->with('success', 'Berhasil menghapus data mapel');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data mapel');
        }
    }
}
