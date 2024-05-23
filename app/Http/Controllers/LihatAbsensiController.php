<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LihatAbsensiController extends Controller
{
    public function absensitgl(Request $req)
    {
        $kelas = Kelas::all();
        if($req->tanggal){
            $absensis = Absensi::with(['kelas'])->whereDate('created_at', $req->tanggal)->whereKelasId( $req->kelas_id)->get();
            $siswas = Siswa::with(['absensis' => function($query) use($req){
                $query->whereDate('created_at', $req->tanggal);
            }])->whereKelasId( $req->kelas_id)->get();
        }else{
            $absensis = Absensi::with(['kelas'])->whereDate('created_at', date('Y-m-d'))->whereKelasId( $req->kelas_id)->get();
            $siswas = Siswa::with(['absensis' => function($query) use($req){
                $query->whereDate('created_at', date('Y-m-d'))->whereKelasId( $req->kelas_id)->get();
            }])->whereKelasId('kelasid', $req->kelas_id)->get();
        }
        return view('admin.lihat-absensi.absensi-tgl', compact('absensis','siswas','kelas'));
    }

    public function cetak_absensi_tgl()
    {
        $kelas = Kelas::all();
        return view('admin.lihat-absensi.cetak-absen-tgl', compact('kelas'));
    }
    public function cetak_absensi_bln()
    {
        $kelas = Kelas::all();
        return view('admin.lihat-absensi.cetak-absen-bln', compact('kelas'));
    }

    public function proses_cetakabsensi_tgl(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $id_kls = $request->id_kls;
        
    //    $tgl = Absensi::select('created_at', date('Y-m-d'));
   
        $data = Absensi::select('absensis.nis','siswas.nm_siswa','absensis.kelas_id')
                        ->join('siswas','absensis.nis','siswas.nis')
                        ->where('siswas.kelas_id','=',$id_kls)
                        ->whereBetween('absensis.created_at', [$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->groupBy('absensis.nis','siswas.nm_siswa','absensis.kelas_id')
                        ->get();
        
        // $nis = $data->nis; 
        // dd($nis);
        foreach ($data as $datas) {
            $nis = $datas->nis;
            $tgl = Absensi::select('created_at')
                    ->where([
                            ['absensis.kelas_id','=',$id_kls],
                            ['nis','=',$nis],
                        ])
                    ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                    ->groupBy('absensis.created_at','absensis.hadir')
                    ->get();
        
            $jmltgl = Absensi::select('created_at')
                    ->where([
                            ['absensis.kelas_id','=',$id_kls],
                            ['nis','=',$nis],
                        ])
                    ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                    ->groupBy('absensis.created_at','absensis.hadir')
                    ->count();

                    
        }
                // dd($tgl);
            $walas = Guru::select('gurus.nm_guru')
                    ->join('wali_kelas','gurus.user_id','wali_kelas.user_id')
                    ->where('wali_kelas.kelas_id','=', $id_kls)
                    ->first();
        
        return view('admin.lihat-absensi.tampil_absen_tgl', compact('data','tgl','tgl_awal','tgl_akhir','jmltgl','id_kls','walas'));
        
    }

    public function proses_cetakabsensi_bln(Request $request)
    {
        $bln_awal = date('Y-m-d',strtotime($request->bln_awal));
        $bln_akhir = date('Y-m-t',strtotime($request->bln_akhir));
        $id_kls = $request->id_kls;
        
        $datas = Absensi::select('absensis.nis','siswas.nm_siswa','absensis.kelas_id','kelas.nm_kls')
                ->join('siswas','absensis.nis','siswas.nis')
                ->join('kelas','absensis.kelas_id','kelas.id')
                ->where('siswas.kelas_id','=',$id_kls)
                ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                ->groupBy('absensis.nis','siswas.nm_siswa','absensis.kelas_id','kelas.nm_kls')
                ->get();
        // dd($datas);

        foreach($datas as $data){
            $dataTgl = Absensi::select(DB::raw('MONTH(created_at) month'), DB::raw('YEAR(created_at) year'))
            ->where([
                ['absensis.kelas_id','=',$id_kls],
                ['nis','=',$data->nis],
            ])
            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
            ->groupBy('year','month')
            ->get();
        }

        $walas = Guru::select('gurus.nm_guru')
                    ->join('wali_kelas','gurus.user_id','wali_kelas.user_id')
                    ->where('wali_kelas.kelas_id','=', $id_kls)
                    ->first();
                
        return view('admin.lihat-absensi.tampil_absen_bln', compact('datas','id_kls','bln_awal','bln_akhir','dataTgl','walas'));
        
    }
}
