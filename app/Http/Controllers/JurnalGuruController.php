<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Tp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JurnalGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->level == 'admin'){
            $guru = Guru::orderBy('nm_guru')->get();
            
            return view('admin.jurnal.index_jurnal', compact('guru'));
        }
        else 
        {
            $user = auth::user()->id; 
            // dd($user); 
            $data = DB::table('guru_ajars')
                    ->join('gurus','guru_ajars.guru_id','=','gurus.id')
                    ->join('mapels','guru_ajars.mapel_id','=','mapels.id')
                    ->join('users','gurus.user_id','=','users.id')
                    ->select('guru_ajars.*','mapels.nm_mapel')
                    ->where('users.id','=',$user)
                    ->get();   
        
            return view('admin.jurnal.show_jurnalguru', compact('data'));
        }
        
        
    }

    public function jurnal_kelas($guru_ajar)
    {
        if(auth()->user()->level == 'admin')
        {
            // ?
            
        }
        else
        {   
            
                $kelas = Kelas::orderBy('nm_kls')->get();  
                $mapel =  DB::table('mapels')
                        ->select('id','alias')
                        ->where('id','=',$guru_ajar)
                        ->get();
                        // dd($mapel); 
                
                $tp = Tp::select('nm_tp')
                        ->where('status','1')
                        ->get();
                return view('admin.jurnal.pilih_kls',compact('kelas','mapel','tp'));
        }
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
        //
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
