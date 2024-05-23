<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Absensi</title>
    <style>
        @media print{@page {size: landscape}}
    </style>
    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>

<body>
<style type="text/css">
        
        table tr th{
            font-size: 10pt;
            text-align: center;
            vertical-align: middle;
            font-family:'Arial Narow OS';
        }
        table td{
            font-size: 10pt;
            font-family:'Arial Narow OS';
        }
    </style>
    @php
        $kls = App\Models\Kelas::select('nm_kls')
        ->where('id','=',$id_kls)
        ->get();
        
    @endphp
    <center>
        <h5>SMK NEGERI 1 WAY PENGUBUAN</h5>
        <h5>LAPORAN DATA ABSENSI
         @foreach($kls as $item)  
            KELAS: {{$item->nm_kls}}</h5>
         @endforeach
    </center>
   <strong>Tanggal : {{ date('d-M-Y', strtotime($tgl_awal))}} s.d {{ date('d-M-Y', strtotime($tgl_akhir))}}</strong> 
    <table id="example1" class="table table-striped table-bordered " width="90%">
        <thead>
            <tr>
                <th rowspan="3">No.</th>
                <th rowspan="3">NIS</th>
                <th rowspan="3">Nama</th>
            </tr>
            <tr>  
                <th colspan="{{ count($tgl) }}">Tanggal</th>
                <th colspan="5">Jumlah</th>
                <th rowspan="2">Total</th>
           
            </tr>
            <tr>
                @foreach($tgl as $tampil)
                <th>{{date('d/m', strtotime($tampil->created_at))}}</th>
                @endforeach
                <th>H</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
                <th>AL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->nm_siswa }}</td>
                    @php
                    $tgl = App\Models\Absensi::select('created_at','hadir')
                    ->where([
                            ['absensis.kelas_id','=',$item->kelas_id],
                            ['nis','=',$item->nis],
                        ])
                    ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                    ->get();
                    @endphp

                    @foreach($tgl as $tanggal)
                    <td class="text-center">    
                        @if ($tanggal->hadir=='h')
                                <i class="fa fa-check fa-sm"></i>
                            @elseif ($tanggal->hadir=='a')
                                <span class="badge bg-danger">A</span>
                            @elseif ($tanggal->hadir=='i')
                                <span class="badge bg-warning">I</span>
                            @elseif ($tanggal->hadir=='s')
                                <span class="badge bg-info">I</span>
                            @else
                                <strong>{{$tanggal->hadir}}</strong>
                            
                                @endif
                    </td>
                    @endforeach
                    <td class="text-center">
                        @php
                        $hadir = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$item->kelas_id],
                                ['nis','=',$item->nis],
                                ['hadir','=','h'],
                            ])
                        ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->count();
                        $total_tgl = count($tgl);
                        $prosentase = ($hadir/$total_tgl) * 100;

                        @endphp
                            <strong><span class="badge bg-success">{{ round($prosentase) }}% </span></strong> 
                    </td>
                    <td class="text-center">
                        @php
                        $hadir = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$item->kelas_id],
                                ['nis','=',$item->nis],
                                ['hadir','=','s'],
                            ])
                        ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->count();
                        @endphp

                        <span class="badge bg-info">{{ $hadir }}</span>
                    </td>
                    <td class="text-center">
                        @php
                        $hadir = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$item->kelas_id],
                                ['nis','=',$item->nis],
                                ['hadir','=','i'],
                            ])
                        ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->count();
                        @endphp

                        <span class="badge bg-warning">{{ $hadir }}</span>
                    </td>
                    <td class="text-center">
                        @php
                        $hadir = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$item->kelas_id],
                                ['nis','=',$item->nis],
                                ['hadir','=','a'],
                            ])
                        ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->count();
                        @endphp

                        <span class="badge bg-danger">{{ $hadir }}</span> 
                    </td>
                    <td class="text-center">
                        @php
                        $hadir = App\Models\Absensi::select('created_at','hadir')
                        ->where([
                                ['absensis.kelas_id','=',$item->kelas_id],
                                ['nis','=',$item->nis],
                                ['hadir','=','al'],
                            ])
                        ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                        ->count();
                        @endphp

                        <strong><span class="badge bg-secondary">{{ $hadir }}</span></strong>
                    </td>
                    <td class="text-center">
                        @php
                        
                        $s = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$item->kelas_id],
                                    ['nis','=',$item->nis],
                                    ['hadir','=','s'],
                                ])
                            ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                            ->count();
                        $i = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$item->kelas_id],
                                    ['nis','=',$item->nis],
                                    ['hadir','=','i'],
                                ])
                            ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                            ->count();
                        $a = App\Models\Absensi::select('created_at','hadir')
                            ->where([
                                    ['absensis.kelas_id','=',$item->kelas_id],
                                    ['nis','=',$item->nis],
                                    ['hadir','=','a'],
                                ])
                            ->whereBetween('absensis.created_at',[$tgl_awal.' 00:00:00', $tgl_akhir.' 23:59:59'])
                            ->count();
                        $total = $s+$i+$a;
                        @endphp

                        <strong><span class="badge bg-primary">{{ $total }}</span></strong>
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
    
    
                           

