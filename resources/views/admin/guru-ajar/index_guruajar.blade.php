@extends('layouts.app', ['title' => 'Guru Mengajar'])

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
    <h1>Data Guru Mengajar:
    @php
        $tp = App\Models\Tp::select('nm_tp','semester')
                ->where('id',$tp_id)
                ->first();
    @endphp
        
            {{$tp->nm_tp}} ({{$tp->semester}})
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"> <a href="{{ route('admin.guru-ajar')}}">Guru Mengajar</a></div>
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
                <table class="table table-striped table-sm table-hover" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Guru</th>
                            <th>Mengajars/kls ;</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                                 
                    @foreach($guru as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nm_guru }}</td>
                                    @php
                                        $guru_ajar  =   App\Models\Guru_ajar::select('mapels.nm_mapel','kelas.nm_kls','tps.nm_tp')
                                                        ->join('mapels','guru_ajars.mapel_id','mapels.id')
                                                        ->join('kelas','guru_ajars.kelas_id','kelas.id')
                                                        ->join('tps','guru_ajars.tp_id','tps.id')
                                                        ->Where([
                                                            ['guru_ajars.guru_id',$item->id],
                                                            ['guru_ajars.tp_id',$tp_id]
                                                            ])
                                                        ->get();
                                    @endphp

                                <td>
                                    
                                    @foreach($guru_ajar as $items)
                                        {{ $items->nm_mapel}}-{{ $items->nm_kls}} ;
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ url('admin/tampil-guru-ajar/'.$item->id.'/'.$tp_id)}}" class="btn btn-primary m-1 "><i class="fas fa-plus"></i></a>
                                    <!-- <a href="{{ route('admin.guru-ajar.show', ['guru_ajar' => $item->id]) }}" class="btn btn-primary m-1 "><i class="fas fa-plus"></i></a> -->
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