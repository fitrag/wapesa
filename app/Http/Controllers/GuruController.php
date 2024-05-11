<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Guru};
use Illuminate\Support\Facades\Hash;

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
        ]);

        $user = User::create([
            'name'          => $request->nama,
            'username'      => $request->username,
            'password'      => $request->username,
            'level'         => 'guru',
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
