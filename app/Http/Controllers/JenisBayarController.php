<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenisbayar;

class JenisBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_bayars = Jenisbayar::all();
        return view('admin.jenis-bayar.index', compact('jenis_bayars'));
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
            'nm_jenis'      => 'required',
            'biaya'         => 'required',
            'kelas'         => 'required',
            'ket'           => 'required',
        ]);

        $jenisbayar = Jenisbayar::create($request->all());
        if($jenisbayar){
            return redirect()->route('admin.jenis-bayar.index')->with('success', 'Berhasil menambahkan data jenis pembayaran');
        }else{
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
    public function destroy(string $id)
    {
        //
    }
}
