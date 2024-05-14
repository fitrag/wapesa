<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $user = User::all();
        return view('admin.siswa.index', compact('siswas','kelas','user'));
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
            'nis'      => 'required',
            'nisn'         => 'required',
            'nm_siswa'         => 'required',
            'tmpt_lhr'         => 'required',
            'tgl_lhr'         => 'required',
            'jen_kel'         => 'required',
            'agama'         => 'required',
            'almt_siswa'         => 'required',
            'no_tlp'         => 'required',
            'nm_ayah'         => 'required',
            'kelas_id'         => 'required',
            'user_id'         => 'required',
        ]);

        $siswa = Siswa::create($request->all());
        if($siswa){
            return redirect()->route('admin.siswa')->with('success', 'Berhasil menambahkan data siswa');
        }else{
            return redirect()->back()->with('success', 'Gagal menambahkan data siswa');
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