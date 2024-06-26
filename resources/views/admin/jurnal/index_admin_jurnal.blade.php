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
    <h1>Jurnal Mengajar Guru</h1>
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
                <table class="table table-striped table-sm table-hover" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">#</th>
                            <th>ID</th>
                            <th>Tahun Pelajaran</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                                 
                    @foreach($tp as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>                               
                                <td>{{ $item->nm_tp}}</td>
                                <td>{{ $item->semester}}</td>
                                <td>
                                    <a href="{{ route('admin.jurnal-guru.show', $item->id) }}" class="btn btn-primary m-1 "><i class="fas fa-eye"></i></a>
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