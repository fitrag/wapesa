<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Jenisbayar, Tp};

class JenisBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tp = Tp::where('status','1')->first();
        $jenis_bayars = Jenisbayar::orderBy('kelas')->get();
        return view('admin.jenis-bayar.index', compact('jenis_bayars','tp'));
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
        try{
            $request->validate([
                'nm_jenis'      => 'required',
                'biaya'         => 'required',
                'kelas'         => 'required',
                'ket'           => 'required',
                'tp_id'         => 'required'
            ]);
            
            $jenisbayar = Jenisbayar::create($request->all());
            if($jenisbayar){
                return redirect()->route('admin.jenis-bayar')->with('success', 'Berhasil menambahkan data jenis pembayaran');
            }else{
                return redirect()->back()->with('success', 'Gagal menambahkan data jenis pembayaran');
            }
        }catch(error){
            return redirect()->back()->with('success', 'Gagal menambahkan data jenis pembayaran');
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
    public function edit(Jenisbayar $jenis_bayar)
    {
        return view('admin.jenis-bayar.edit', compact('jenis_bayar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenisbayar $jenis_bayar)
    {
        $update = $jenis_bayar->update($request->all());
        if($update){
            return redirect()->route('admin.jenis-bayar')->with('success', 'Berhasil memperbarui data jenis pembayaran');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data jenis pembayaran');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenisbayar $jenis_bayar)
    {
        $delete = $jenis_bayar->delete();
        if($delete){
            return redirect()->route('admin.jenis-bayar')->with('success', 'Berhasil menghapus data jenis pembayaran');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data jenis pembayaran');
        }
    }
}
