@extends('layouts.app', ['title' => 'Jurnal Guru'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Jurnal Mengajar Dari : 
        @php
            $guru = App\Models\Guru::select('nm_guru')
                    ->where('id',$guru_id)
                    ->first();
        @endphp
        {{$guru->nm_guru}} </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.jurnal-guru')}}">Jurnal Mengajar</a></div>
       
    </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    @foreach($datax as $item)

                        <div class="form-group py-2 col-6">
                            <a href="{{ url('cetak.jurnalpdf/'.$item->mapel_id.'/'.$item->guru_id.'/'.$item->kelas_id.'/'.$item->tp_id ) }}" class="btn btn-info btn-rounded btn-fw" target="_blank"><i class="fa fa-print"></i> Cetak- {{$item->alias}} - {{$item->nm_kls}} </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm ">
                                    <tr>
                                        <th colspan="10" class="text-center">LEMBAR JURNAL GURU</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3" width="20%">NAMA SEKOLAH</td>
                                        <td width="1%">:</td>
                                        <td colspan="2" width="40%">
                                                {{ $pengaturan->nama_sekolah}}
                                        </td>
                                        <td colspan="2">TAHUN AJARAN</td>
                                        <td>:</td>
                                        <td colspan="2">
                                                {{ $item->nm_tp}}
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3">MATA PELAJARAN</td>
                                        <td>:</td>
                                            
                                        <td colspan="2">
                                            {{$item->nm_mapel}}
                                        </td>

                                        <td colspan="2">SEMESTER</td>
                                        <td>:</td>
                                        <td colspan="2">
                                            {{$item->semester}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Nama Guru</td>
                                        <td>:</td>
                                            
                                        <td colspan="2">
                                        {{$item->nm_guru}}
                                        </td>

                                        <td colspan="2">Kelas</td>
                                        <td>:</td>
                                            
                                        <td colspan="2">
                                            {{$item->nm_kls}}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive py-4">
                                <table class="table table-striped table-sm table-hover table-bordered" id="table">
                                    <thead>
                                        <tr>
                                        <td><strong>No.</strong></td>
                                        <td><strong>Hari/Tanggal</strong> </td>
                                        <td><strong>Jam Ke</strong></td>
                                        <td><strong>Kelas</strong></td>
                                        <td><strong>Materi Pokok/Sub Materi</strong></td>
                                        <td><strong>TM Ke</strong></td>
                                        <td><strong>Selesai/tidak alasan</strong></td>
                                        <td><strong>Absensi</strong></td>
                                        <td><strong>Ket</strong> </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $data = App\Models\Jurnal::select('jurnals.*','mapels.nm_mapel','kelas.nm_kls')
                                            ->join('gurus','jurnals.guru_id','=','gurus.id')
                                            ->join('mapels','jurnals.mapel_id','=','mapels.id')
                                            ->join('kelas','jurnals.kelas_id','=','kelas.id')
                                            ->where([
                                                ['jurnals.guru_id','=',$item->guru_id],
                                                ['jurnals.kelas_id','=',$item->kelas_id],
                                                ['jurnals.tp_id','=',$item->tp_id],
                                                ['jurnals.mapel_id','=',$item->mapel_id],
                                                ])
                                            ->orderBy('jurnals.tmke')
                                            ->get();

                                        @endphp
                                    @foreach($data as $items)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                {{ Carbon\Carbon::parse($items->tgl)->isoFormat('dddd, D/MM/YYYY')}}</td>
                                                <td>{{$items->jamke}}</td>
                                                <td>{{$items->nm_kls}}</td>
                                                <td>{{$items->materi}}</td>
                                                <td>{{$items->tmke}}</td>
                                                <td>{{$items->status}}</td>
                                                <td>{{$items->absensi}}</td>
                                                <td>{{$items->ket}}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection