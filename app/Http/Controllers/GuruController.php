<?php

namespace App\Http\Controllers;

use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Models\{User, Guru};
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use File;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::all();
        return view('admin.guru.index', compact('gurus'));
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
            'username'  => 'required',
            'nip'       => 'required',
            'nuptk'     => 'required',
            'nama'      => 'required',
            'is_walas'  => 'required',
            'is_gurupiket'  => 'required',
        ]);

        $user = User::create([
            'name'          => $request->nama,
            'username'      => $request->username,
            'password'      => $request->username,
            'level'         => 'guru',
            'is_walas'      => $request->is_walas,
            'is_gurupiket'  => $request->is_gurupiket,
        ]);

        $guru = Guru::create([
            'user_id'       => $user->id,
            'nip'           => $request->nip,
            'nuptk'         => $request->nuptk,
            'nm_guru'       => $request->nama,
        ]);
        if($guru && $user){
            return redirect()->route('admin.guru')->with('success','Berhasil menambahkan data');
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
    public function edit(Guru $guru)
    {
        $user = User::all();
        return view('admin.guru.edit_guru',compact('guru','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        
        $update = $guru->update($request->all());
        if($update){
            return redirect()->route('admin.guru')->with('success', 'Berhasil memperbarui data guru');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data guru');
        }
    }

    public function import(Request $request){
        $file = $request->file('file');

        // membuat nama file unik
        
        if($request->hasFile('file')){
            $nama_file = $file->getClientOriginalName();
            $file_path = $file->move('excel/',$nama_file);
            $import = Excel::import(new GuruImport, $file_path);

            if($import){
                 File::delete($file_path);
                return redirect()->route('admin.guru')->with('success', 'Berhasil mengimport data');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $delete = $guru->delete();
        if($delete){
            $guru->user->delete();
            return redirect()->route('admin.guru')->with('success','Berhasil menghapus data');
        }
    }
}
