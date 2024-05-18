<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

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

    public function import(Request $request){
        $file = $request->file('file');

        // membuat nama file unik
        
        if($request->hasFile('file')){
            $nama_file = $file->getClientOriginalName();
            $file_path = $file->move('excel/',$nama_file);
            $import = Excel::import(new SiswaImport(), $file_path);

            if($import){
                 File::delete($file_path);
                return redirect()->route('admin.siswa')->with('success', 'Berhasil mengimport data');
            }
        }
    }
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
        ]);

        $user = User::create([
            'name'          => $request->nm_siswa,
            'username'      => $request->nis,
            'password'      => Hash::make($request->nisn),
            'level'         => 'siswa'
        ]);
        if($user){
            $siswa = Siswa::create([
                'nis'           => $request->nis,
                'nisn'          => $request->nisn,
                'nm_siswa'      => $request->nm_siswa,
                'tmpt_lhr'      => $request->tmpt_lhr,
                'jen_kel'       => $request->jen_kel,
                'agama'         => $request->agama,
                'almt_siswa'    => $request->almt_siswa,
                'no_tlp'        => $request->no_tlp,
                'nm_ayah'       => $request->nm_ayah,
                'kelas_id'      => $request->kelas_id,
                'user_id'       => $user->id,
            ]);
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
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $user = User::all();
        return view('admin.siswa.edit_siswa', compact('siswa','kelas','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $update = $siswa->update($request->all());
        if($update){
            return redirect()->route('admin.siswa')->with('success', 'Berhasil memperbarui data siswa');
        }else{
            return redirect()->back()->with('success', 'Gagal memperbarui data siswa');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $delete = $siswa->delete();
        if($delete){
            $siswa->user->delete();
            return redirect()->route('admin.siswa')->with('success', 'Berhasil menghapus data siswa');
        }else{
            return redirect()->back()->with('success', 'Gagal menghapus data siswa');
        }
    }

    public function qrcode(Siswa $siswa){
        $qrCode = QrCode::size(80)->generate($siswa->nis);
        return view('admin.siswa.qrcode', compact('qrCode','siswa'));
    }
    public function ajax(Request $req){
        if($req->ajax()){
            return DataTables::of(Siswa::latest())
            ->AddColumn('nis', function($data){
                return "No";
            })
            ->AddColumn('nisn', function($data){
                return "No";
            })
            ->AddColumn('nama', function($data){
                return "No";
            })
            ->AddColumn('kelas', function($data){
                return "No";
            })
            ->AddColumn('username', function($data){
                return "No";
            })
            ->AddColumn('action', function($data){
                return "No";
            })
            ->make(true);
        }
    }
}
