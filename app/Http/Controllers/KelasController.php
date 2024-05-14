<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index_kls', compact('kelas'));
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
            'nm_kls'      => 'required',
            'alias'         => 'required',
        ]);

        $kelas = Kelas::create($request->all());
        if($kelas){
            return redirect()->route('admin.kelas')->with('success', 'Berhasil menambahkan data kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data kelas');
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
    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit_kls', compact('kela'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $update = $kela->update($request->all());
        if($update){
            return redirect()->route('admin.kelas')->with('success', 'Berhasil memperbarui data kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $delete = $kela->delete();
        if($delete){
            return redirect()->route('admin.kelas')->with('success', 'Berhasil menghapus data kelas');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data kelas');
        }
    }
}