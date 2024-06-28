<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Absensi</title>
    <style>
        @media print{@page {size: portrait}}
    </style>
    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <style type="text/css">
            
            table tr th{
                font-size: 10pt;
                text-align: center;
                vertical-align: middle;
                font-family:"Arial Narrow", Arial, sans-serif;
            }
            table td{
                font-size: 10pt;
                font-family:"Arial Narrow", Arial, sans-serif;
            }
    </style>
</head>
<body>
    
@php
        $kls = App\Models\Kelas::select('nm_kls')
        ->where('id','=',$id_kls)
        ->get();
        
    @endphp
    <div class="text-center">
        <img src="{{asset('img/kop.png')}}" alt="" srcset="">
        <br>
        <h5>Laporan Data Absensi</h5>
        <h5><p>Kelas: {{ $datas[0]->nm_kls }} </p></h5>
        
    </div>

    <h5><strong>Periode Bulan: {{ date('M-Y', strtotime($bln_awal))}} s.d {{ date('M-Y', strtotime($bln_akhir))}}</strong></h5>
    <table id="example1" class="table table-striped table-bordered table-sm"  width="90%">
        <thead>
            <tr>
                <th rowspan="3" width="4%">No.</th>
                <th rowspan="3" width="8%">NIS</th>
                <th rowspan="3" width="18%">Nama</th>
            </tr>
            <tr>
                @foreach($dataTgl as $tgl)
                <th colspan="5">
                    {{ date('F', strtotime(date('Y').'-'.$tgl->month)) }}
                </th>
                @endforeach

                <th rowspan="1" colspan="5">Total</th>
                <tr>
                    @foreach($dataTgl as $tgl)
                    <th>H</th>
                    <th>S</th>
                    <th>I</th>
                    <th>A</th>
                    <th>AL</th>
                    @endforeach

                    <th>H</th>
                    <th>S</th>
                    <th>I</th>
                    <th>A</th>
                    <th>AL</th>
                </tr>
                
            </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
                @php
                    $s = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$data->kelas_id],
                                ['nis','=',$data->nis],
                                ['hadir','=','s'],
                            ])
                        ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                        ->count();
                    $h = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$data->kelas_id],
                                ['nis','=',$data->nis],
                                ['hadir','=','h'],
                            ])
                        ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                        ->count();
                    $i = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$data->kelas_id],
                                ['nis','=',$data->nis],
                                ['hadir','=','i'],
                            ])
                        ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                        ->count();
                    $a = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$data->kelas_id],
                                ['nis','=',$data->nis],
                                ['hadir','=','a'],
                            ])
                        ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                        ->count();
                    $al = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$data->kelas_id],
                                ['nis','=',$data->nis],
                                ['hadir','=','al'],
                            ])
                        ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                        ->count();
                    $total = $s+$i+$a;
                @endphp
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $data->nis }}</td>
                <td>{{ $data->nm_siswa }}</td>
                @foreach($dataTgl as $tgl)
                    @php

                    

                    $hBulan = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->where('hadir','h')
                        ->whereMonth('created_at', $tgl->month)->count();
                    
                    $tgls = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->whereMonth('created_at', $tgl->month)->count();
                        
                        


                    $iBulan = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->where('hadir','i')
                        ->whereMonth('created_at', $tgl->month)->count();
                    $sBulan = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->where('hadir','s')
                        ->whereMonth('created_at', $tgl->month)->count();
                    $aBulan = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->where('hadir','a')
                        ->whereMonth('created_at', $tgl->month)->count();
                    $alBulan = App\Models\Absensi::where([
                        'kelas_id' => $id_kls,
                        'nis'    => $data->nis
                        ])
                        ->where('hadir','al')
                        ->whereMonth('created_at', $tgl->month)->count();

                        $prosentase = ($hBulan/$tgls) * 100;

                    @endphp
                    <td align="center">
                        <span class="">
                            {{ round($prosentase) }}%
                        </span>
                    </td>
                    <td align="center">
                        <span class="">{{ $sBulan }} </span>

                    </td>
                    <td align="center">
                        <span class="">    {{ $iBulan }} </span>

                    </td>
                    <td align="center">
                        <span class="">{{ $aBulan }}</span> 
                    </td>
                    <td align="center">
                        <span class="">{{ $alBulan }}</span> 
                    </td>
                @endforeach

                <td align="center">
                    @php    
                        $h = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$data->kelas_id],
                                    ['nis','=',$data->nis],
                                    ['hadir','=','h'],
                                ])
                            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                            ->count();
                        $hall = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$data->kelas_id],
                                    ['nis','=',$data->nis],
                                ])
                            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                            ->count();

                            $prosentase = ($h/$hall) * 100;
                    @endphp
                    <span class="">
                        <b>{{ round($prosentase) }}%</b>
                        
                    </span>
                </td>
                <td class="text-center">
                    @php 
                    $s = App\Models\Absensi::select('created_at','hadir')
                                ->where([
                                        ['absensis.kelas_id','=',$data->kelas_id],
                                        ['nis','=',$data->nis],
                                        ['hadir','=','s'],
                                    ])
                                ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                                ->count();
                    @endphp
                    <span class=""><b>{{ $s }}</b> </span>
                </td>
                <td class="text-center">
                    @php
                
                        $i = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$data->kelas_id],
                                    ['nis','=',$data->nis],
                                    ['hadir','=','i'],
                                ])
                            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                            ->count();
                    
                    @endphp
                    <span class=""><b>{{ $i }}</b> </span>
                </td>
                <td class="text-center">
                    @php
                        $a = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$data->kelas_id],
                                    ['nis','=',$data->nis],
                                    ['hadir','=','a'],
                                ])
                            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                            ->count();
                    @endphp
                    <span class=""><b>{{ $a }}</b> </span>
                </td>
                <td class="text-center">
                    @php
                        $al = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$data->kelas_id],
                                    ['nis','=',$data->nis],
                                    ['hadir','=','al'],
                                ])
                            ->whereBetween('absensis.created_at',[$bln_awal, $bln_akhir])
                            ->count();
                    @endphp
                    <span class=""><b>{{ $al }}</b> </span>
                </td>

            </tr>

        @endforeach
            
        </tbody>
    </table>

    <table border="0">
        <tr>
            <td width='600'></td>
            <td>Wali Kelas</td>
            
        </tr>
        <tr>
            <td></td>
            <td height='80'></td>
        </tr>
        <tr>
            <td></td>
            <td> <strong>( {{ $walas->nm_guru }} )</strong> </td>
        </tr>

    </table>
    <script type="text/javascript">
        window.print();
    </script>
     
</body>
</html>
    
    
                           

