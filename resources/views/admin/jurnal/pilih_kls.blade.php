@extends('layouts.app', ['title' => 'Jurnal Kelas'])

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
    <h1>Pilih Kelas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Pilih Kelas</a></div>
        <div class="breadcrumb-item"> <a href="{{ route('admin.jurnal-guru')}}">Pilih Kelas</a></div>
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
                <form method="GET" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="alias">Mapel</label>
                        <select class="form-control" name="mapel_id">
                            @foreach($mapel as $item)
                                <option value="{{$item->id}}">{{$item->alias}}</option>
                            @endforeach
                        </select>
                        @error('mapel_id')
                        <div class="alert alert-danger">Mohon di isi mapel</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi mapel
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alias">Kelas</label>
                        <select class="form-control" name="kelas_id" required="">
                            <option value="">(Pilih Kelas)</option>
                            @foreach($kelas as $item)
                                <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                        <div class="alert alert-danger">Mohon di isi kelas</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi kelas
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alias">Kelas</label>
                        <select class="form-control" name="tp_id" required="">
                            <option value="">(Pilih Tahun Pelajaran)</option>
                            @foreach($tp as $item)
                                <option value="{{$item->id}}">{{$item->nm_tp}}</option>
                            @endforeach
                        </select>
                        @error('tp_id')
                        <div class="alert alert-danger">Mohon di isi tp</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi tp
                        </div>
                    </div>

                    
                                
                               
                                <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                                    <label for="semester" class="col-md-6 control-label">Semester</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="semester" required="">
                                            <option value="">(Pilih Semester)</option>
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        </select>
                                    </div>
                                </div>
                            

                                <button type="submit" class="btn btn-primary pull-left mr-1" id="submit">
                                            Go
                                </button>
                                <a href="" class="btn btn-dark pull-left">Back</a>
                            </div>           
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection