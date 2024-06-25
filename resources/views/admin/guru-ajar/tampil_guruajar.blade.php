@extends('layouts.app', ['title' => 'Tambah Guru Mengajar'])

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
    <h1> 
        Nama Guru : {{ $guru->nm_guru}}
       
    </h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"> <a href="{{ route('admin.guru-ajar')}}">Guru Mengajar</a></div>
        <div class="breadcrumb-item">Tambah Guru Ajar</div>
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
            <div class="p-3">
                <button class="btn btn-primary float-right mb-1" data-target="#exampleModal" data-toggle="modal">Tambah Data</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped  table-hover" id="table-1">
                    <thead>                                 
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Mapel</th>
                            <th></th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                                 
                    @foreach($mapel as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nm_mapel }}</td>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        
                                        <form action="{{ route('admin.guru-ajar.delete', ['guru_ajar' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-1"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
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

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">  
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Mengajar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('admin.guru-ajar.store') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="name">Nama Mapel</label>
                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                    <select class="form-control" name="mapel_id" required="">
                        <option value="">--Pilih--</option>
                        @foreach($mapels as $item)
                            <option value="{{$item->id}}">{{$item->nm_mapel}}</option>
                        @endforeach
                </select>
                @error('id_kls')
                    <div class="alert alert-danger">Mohon di isi nama kelas</div>
                @enderror
                <div class="invalid-feedback">
                    Mohon di isi kelas
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Tambah
                    </button>
                    <input type="reset" value="Reset" class="btn btn-danger btn-lg btn-block">
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>

@endsection