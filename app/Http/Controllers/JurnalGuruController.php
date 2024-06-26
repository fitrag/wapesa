<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Guru_ajar;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Pengaturan;
use App\Models\Tp;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
            $tp = Tp::orderBy('nm_tp')->get();
            return view('admin.jurnal.index_admin_jurnal', compact('tp'));
        }
        else 
        {
            $user = auth::user()->id; 
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
                $tps = Tp::where('status',1)->first();
                $tp = Tp::all();
                return view('admin.jurnal.pilih_kls',compact('kelas','mapel','tp','tps'));
        }
    }
    public function jurnal_mapel(Request $req)
    {
        if(auth()->user()->level == 'admin')
        {
            // ?
            
        }
        else
        {   
            $user = auth::user()->id;
            $mapel_id = $req->mapel_id;
            $kelas_id = $req->kelas_id;
            $tp_id = $req->tp_id;
            // $semester = $req->semester;
            $guru_id = DB::table('gurus')
                    ->join('users','gurus.user_id','users.id')
                    ->select('gurus.id')
                    ->where('gurus.user_id','=',$user)
                    ->first();

            //jika belum pernah input data
            $data = DB::table('jurnals')
                    ->join('gurus','jurnals.guru_id','=','gurus.id')
                    ->join('mapels','jurnals.mapel_id','=','mapels.id')
                    ->join('kelas','jurnals.kelas_id','=','kelas.id')
                    ->join('tps','jurnals.tp_id','=','tps.id')
                    ->select('jurnals.*','mapels.nm_mapel','kelas.nm_kls','tps.nm_tp')
                    ->where([
                        ['jurnals.guru_id','=',$guru_id->id],
                        ['jurnals.mapel_id','=',$mapel_id],
                        ['jurnals.kelas_id','=',$kelas_id],
                        ['jurnals.tp_id','=',$tp_id],
                        ])
                    ->orderBy('jurnals.tmke')
                    ->get();

            //Jika sudah pernah input data
            $datax = DB::table('jurnals')
                ->join('mapels','jurnals.mapel_id','=','mapels.id')
                ->join('tps','jurnals.tp_id','=','tps.id')
                ->select('jurnals.mapel_id','tps.nm_tp','tps.semester','mapels.nm_mapel')
                ->where([
                        ['jurnals.guru_id','=',$guru_id->id],
                        ['jurnals.mapel_id','=',$mapel_id],
                        ['jurnals.kelas_id','=',$kelas_id],
                        ['jurnals.tp_id','=',$tp_id],
                    ])
                ->groupBy('jurnals.mapel_id','tps.nm_tp','tps.semester','mapels.nm_mapel')
                ->get();

                $pengaturan = Pengaturan::all();
            

            if (count($data) != 0 )       
            {
                return view('admin.jurnal.show_jurnal_mapel',compact('data','datax','pengaturan')); 
                // dd($datax);
            }
            else
            {
                {
                    $kelas_id = $req->kelas_id;
                    $tp_id = $req->tp_id;
    
                    $user = auth::user()->id;
                    $guru_id = DB::table('gurus')
                        ->join('users','gurus.user_id','users.id')
                        ->select('gurus.*')
                        ->where('gurus.user_id','=',$user)
                        ->first();

                    // $data = DB::table('tr_guru_mapel')
                    //     ->join('gurus','tr_guru_mapel.guru_id','=','gurus.id')
                    //     ->join('mapels','tr_guru_mapel.id_mapel','=','mapels.id')
                    //     ->select('tr_guru_mapel.*','mapels.nm_mapel','mapels.alias')
                    //     ->where([
                    //         ['tr_guru_mapel.id_guru','=',$user],
                    //         ['tr_guru_mapel.id_mapel','=',$id_mapel],
                    //         ])
                    //     ->get();
                    $tp = DB::table('tps')
                            ->select('id','nm_tp','semester')  
                            ->where('id','=',$tp_id)
                            ->get();
                    $mapel = DB::table('guru_ajars')
                            ->join('mapels','guru_ajars.mapel_id','=','mapels.id') 
                            ->select('guru_ajars.mapel_id','mapels.alias')  
                            ->where([
                                ['guru_ajars.guru_id','=',$guru_id->id],
                                ['guru_ajars.mapel_id','=',$mapel_id],
                                ])
                            ->groupBy('guru_ajars.mapel_id','mapels.alias')
                            ->get();
                    $kelas = DB::table('kelas')
                            ->select('id','nm_kls')  
                            ->where('id','=',$kelas_id)
                            ->get();  

                    
                    $guru = Guru::all();
                    return view('admin.jurnal.create_jurnal_mapel', compact('guru_id','guru','mapel','kelas','tp'));
                    // dd($data);
                }
            }

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
        $request->validate([
            'tgl'      => 'required',
            'jamke'         => 'required',
            'materi'         => 'required',
            'tmke'         => 'required',
            'status'         => 'required',
            'absensi'         => 'required',
        ]);

        if(auth()->user()->level == 'admin')
        {
            // ?
            
        }
        else
        { 
            $jurnal = Jurnal::create($request->all());


            if($jurnal){
                return redirect()->back()->with('success', 'Berhasil menambahkan data jurnal');
            }else{
                return redirect()->back()->with('success', 'Gagal menambahkan data jurnal');
            }
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $guru_ajar = DB::table('guru_ajars')
                    ->join('gurus','guru_ajars.guru_id','gurus.id')
                    ->select('gurus.id','gurus.nm_guru')
                    ->orderBy('gurus.nm_guru')
                    ->groupBy('gurus.id','gurus.nm_guru')
                    ->get();
       $tp_id = $id;


        return view('admin.jurnal.show_jurnal_admin', compact('guru_ajar','tp_id'));
    }

    public function jurnal_admin_perguru($guru_id, $tp_id)
    {
        
        $datax = DB::table('jurnals')
                    ->join('gurus','jurnals.guru_id','=','gurus.id')
                    ->join('mapels','jurnals.mapel_id','=','mapels.id')
                    ->join('kelas','jurnals.kelas_id','=','kelas.id')
                    ->join('tps','jurnals.tp_id','=','tps.id')
                    ->select('jurnals.mapel_id','tps.nm_tp','tps.semester','jurnals.kelas_id','mapels.nm_mapel','mapels.alias','kelas.nm_kls','jurnals.guru_id','gurus.nm_guru','jurnals.tp_id')
                    ->where([
                        ['jurnals.guru_id','=',$guru_id],
                        ['jurnals.tp_id','=',$tp_id],
                        ])
                    ->groupBy('jurnals.mapel_id','tps.nm_tp','tps.semester','jurnals.kelas_id','mapels.nm_mapel','mapels.alias','kelas.nm_kls','jurnals.guru_id','gurus.nm_guru','jurnals.tp_id')
                    ->get();

            $pengaturan = Pengaturan::first();            
        return view('admin.jurnal.show_jurnal_adminguru', compact('datax','guru_id','pengaturan')); 
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $update = $id->update($request->all());

        $user = Auth::user()->id;
        $guru_id = DB::table('gurus')
                        ->join('users','gurus.user_id','users.id')
                        ->select('gurus.*')
                        ->where('gurus.user_id','=',$user)
                        ->first();
// dd($guru_id);
        Jurnal::find($id)->update([
            'guru_id'     => $guru_id->id,
            'mapel_id'    => $request->get('mapel_id'),
            'tp_id'       => $request->get('tp_id'),
            'kelas_id'     => $request->get('kelas_id'),
            'tgl'         => $request->get('tgl'),
            'jamke'       => $request->get('jamke'),
            'materi'      => $request->get('materi'),
            'tmke'        => $request->get('tmke'),
            'status'      => $request->get('status'),
            'absensi'     => $request->get('absensi'),
            'ket'         => $request->get('ket')
            ]);

        // if($update){
            return redirect()->back()->with('success', 'Berhasil memperbarui data jurnal');
        // }else{
        //     return redirect()->back()->with('success', 'Gagal memperbarui data jurnal');
        // }
    }

    public function cetakpdf($mapel_id, $guru_id, $kelas_id, $tp_id)
    {
        date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
        Carbon::now();
        $date = Carbon::now()->isoFormat('D MMMM Y');

        $data = DB::table('jurnals')
        ->join('gurus','jurnals.guru_id','=','gurus.id')
        ->join('mapels','jurnals.mapel_id','=','mapels.id')
        ->join('kelas','jurnals.kelas_id','=','kelas.id')
        ->select('jurnals.*','mapels.nm_mapel','kelas.nm_kls','gurus.nm_guru','gurus.nip')
        ->where([
            ['jurnals.guru_id','=',$guru_id],
            ['jurnals.mapel_id','=',$mapel_id],
            ['jurnals.kelas_id','=',$kelas_id],
            ['jurnals.tp_id','=',$tp_id],
            ])
        ->orderBy('jurnals.tgl')
        ->get();

    $datax = DB::table('jurnals')
        ->join('mapels','jurnals.mapel_id','=','mapels.id')
        ->select('jurnals.mapel_id','tps.semester','tps.nm_tp','mapels.nm_mapel')
        ->join('tps','jurnals.tp_id','=','tps.id')
        ->where([
            ['jurnals.guru_id','=',$guru_id],
            ['jurnals.mapel_id','=',$mapel_id],
            ['jurnals.kelas_id','=',$kelas_id],
            ])
        ->groupBy('jurnals.mapel_id','tps.semester','tps.nm_tp','mapels.nm_mapel')
        ->get();
    $pengaturan = Pengaturan::all();
    
    // $pdf =  PDF::loadView('admin.jurnal.cetak_pdf', compact('data','datax','date','pengaturan'));
    //     return $pdf->stream('cetak.pdf');

   
    return view('admin.jurnal.cetak_pdf', compact('data','datax','date','pengaturan'));
      

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            Jurnal::find($id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data jurnal');
         }
    }
}
