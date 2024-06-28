<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Absensi</title>

    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
            font-family:"Arial Narrow", Arial, sans-serif;
        }
        
    </style>
    <center class="py-2">
        <img src="{{asset('img/kop.png')}}" alt="" srcset="">
    </center>
        <center class="py-2">
            <h5>JURNAL GURU</h5>
        </center>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm" width="90%">
                    <tr>
                        <th colspan="3" width="13%">NAMA SEKOLAH</th>
                        <th width="1%">:</th>
                        <th colspan="2" width="50%">
                            @foreach($pengaturan as $item)
                                {{ $item->nama_sekolah}}
                            @endforeach
                        </th>
                        
                        <th colspan="2" width="10%">TAHUN AJARAN</th>
                        <th>:</th>
                        <th colspan="2">
                            @foreach($datax as $item)
                                {{ $item->nm_tp}}
                            @endforeach    
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">MATA PELAJARAN</th>
                        <th>:</th>
                        <th colspan="2">
                            @foreach($datax as $item)
                            {{$item->nm_mapel}}
                            @endforeach 
                        </th>
    
                        <th colspan="2">SEMESTER</th>
                        <th>:</th>
                        @foreach($datax as $item)
                            <th colspan="2">
                                {{$item->semester}}
                            </th>
                        @endforeach 
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th></th>
                        <th colspan="2"></th>
                        <th colspan=""></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>

            </div>
        </div>

                    <table class="table table-striped table-md table-bordered" id="table" width="90%">
                        <thead class="thead-light">
                        <tr>
                            <th width="2%">No.</th>
                            <th width="9%">Hari/Tanggal</th>
                            <th width="3%">Jam Ke</th>
                            <th width="6%">Kelas</th>
                            <th>Materi Pokok/Sub Materi</th>
                            <th width="2%">TM Ke</th>
                            <th width="15%">Selesai/tidak alasan</th>
                            <th width="15%">Absensi</th>
                            <th width="10%">Ket</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($item->tgl)->isoFormat('dddd, D/MM/YYYY') }}
                                    <!-- {{date('l, d/m/Y', strtotime($item->tgl))}} -->
                                </td>
                                <td>{{$item->jamke}}</td>
                                <td>{{$item->nm_kls}}</td>
                                <td>{{$item->materi}}</td>
                                <td>{{$item->tmke}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->absensi}}</td>
                                <td>{{$item->ket}}</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <table>
                        <tr>
                            <td width="83%"></td>
                            <td width="20%">Seputih Agung, {{$date}}</td>
                        </tr>
                        <tr>
                            <td height="40"></td>
                        </tr>
                        <tr>
                            <td width="65%"></td>
                            <td><B>{{$item->nm_guru}}</B></td>
                            
                        </tr>
                        <tr>
                            <td width="65%"></td>
                            <td >NIP. {{$item->nip}}</td>
                            
                        </tr>
                    </table>

                    <script type="text/javascript">
                        window.print();
                    </script>

</body>
</html>
    
