@extends('layouts.app', ['title' => 'Edit Mapel'])

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
    <h1>Edit Mapel</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Edit Mapel</a></div>
        <div class="breadcrumb-item">Edit Mapel</div>
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
                  <form method="POST" action="{{ route('mapel.update', ['mapel' => $mapel->id]) }}" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <label for="name">Nama mapel</label>
                    <input id="name" type="text" class="form-control" value="{{ $mapel->nm_mapel}}" name="nm_mapel" tabindex="1" placeholder="contoh: X RPL 1" required autofocus>
                    @error('nm_mapel')
                      <div class="alert alert-danger">Mohon di isi nama mapel</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama mapel
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="alias">Alias / Singkatan</label>
                    <input id="alias" type="text" class="form-control" value="{{ $mapel->alias }}" name="alias" tabindex="1" placeholder="contoh: X" required autofocus>
                    @error('alias')
                      <div class="alert alert-danger">Mohon di isi alias</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi alias
                    </div>
                  </div>
                  

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Perbarui
                      </button>
                      <input type="reset" value="Reset" class="btn btn-danger btn-lg btn-block">
                    </div>
                  </form>
              </div>
          </div>
          </div>
      </div>
    </div>
</section>

       

@endsection