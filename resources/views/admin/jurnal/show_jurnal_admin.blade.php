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
    <h1>Jurnal Mengajar Tahun : 
        @php
            $tp = App\Models\Tp::select('nm_tp','semester')
                    ->where('id',$tp_id)
                    ->first();
        @endphp
        
            {{$tp->nm_tp}} ({{$tp->semester}})
       
    </h1>
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
            
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Guru</th>
                            <th>Mengajar / (Sudah Input Jurnal)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                                 
                        @foreach($guru_ajar as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nm_guru }}</td>
                                @php
                                    $mapel  =   App\Models\Guru_ajar::select('mapels.alias','guru_ajars.id','guru_ajars.mapel_id','kelas.nm_kls','guru_ajars.kelas_id')
                                                    ->join('mapels','guru_ajars.mapel_id','mapels.id')
                                                    ->join('tps','guru_ajars.tp_id','tps.id')
                                                    ->join('kelas','guru_ajars.kelas_id','kelas.id')
                                                    ->Where([
                                                        ['guru_ajars.guru_id',$item->id],
                                                        ['guru_ajars.tp_id',$tp_id]
                                                        ])
                                                    ->get();
                                @endphp
                                <td>
                                    @foreach($mapel as $items)
                                        @php
                                            $count_jurnal  =   App\Models\Jurnal::Where([
                                                    ['jurnals.mapel_id','=',$items->mapel_id],
                                                    ['jurnals.tp_id','=',$tp_id],
                                                    ['jurnals.kelas_id','=',$items->kelas_id],
                                                ])
                                                    ->count();
                                        @endphp
                                            {{ $items->alias}}({{$items->nm_kls}}) / <b>({{$count_jurnal}}-Pertemuan)</b>; 
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ url('admin/jurnal/tampil_jurnal_admin/'.$item->id.'/'.$tp_id)}}" class="btn btn-primary m-1 "><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection