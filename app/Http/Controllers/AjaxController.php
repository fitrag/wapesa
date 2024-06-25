<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    function tambahJurnal(Request $req)
    {
        $mapel_id = $req->mapel_id;
        $tp_id = $req->tp_id;
        $semester = $req->semester;
        $kelas_id = $req->kelas_id;
        
        if (Auth::user()->role->is_admin)
        {
            // ?
            
        }
        else
        {
            $user = auth::user()->id;
            $guru_id = DB::table('gurus')
                ->join('users','gurus.user_id','users.id')
                ->select('gurus.id')
                ->where('gurus.user_id','=',$user)
                ->first();

                $data = DB::table('guru_ajars')
                    ->join('gurus','guru_ajars.guru_id','=','gurus.id')
                    ->join('mapels','guru_ajars.mapel_id','=','mapels.id')
                    ->select('guru_ajars.*','mapels.nm_mapel','mapels.alias')
                    ->where([
                            ['guru_ajars.guru_id','=',$guru_id->id],
                            ['guru_ajars.mapel_id','=',$mapel_id],
                        ])
                    ->get();

                

                // $tp = Tp::all();
                // $tps = DB::table('tps')
                //     ->select('id','nm_tp')  
                //     ->where('id','=',$tp_id)
                //     ->get();
                $mapel = DB::table('guru_ajars')
                        ->join('mapels','guru_ajars.mapel_id','=','mapels.id') 
                        ->select('guru_ajars.mapel_id','mapels.alias')  
                        ->where([
                            ['guru_ajars.guru_id','=',$guru_id],
                            ['guru_ajars.mapel_id','=',$mapel_id],
                            ])
                        ->groupBy('guru_ajars.mapel_id','mapels.alias')
                        ->get();
                // $kelas = Kelas::orderBy('nm_kls')->get(); 
                // $kelas = DB::table('kelas')
                //         ->select('id','nm_kls')  
                //         ->where('id','=',$kelas_id)
                //         ->get();
                $guru = Guru::all();
                return view('admin.jurnal.ajax_tambah_jurnal',compact('data','guru_id','mapel'));
                // dd($tp_id);
                        }
    }

}
