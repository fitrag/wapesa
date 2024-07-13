@extends('layouts.app', ['title' => 'Edit Tempat Prakerin'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
  function deteksiLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(lihatPosisi);
        } else { 
            x.innerHTML = "Browser tidak support GPS";
        }
    }

    function lihatPosisi(posisi){
        $('#latitude').val(posisi.coords.latitude)
        $('#longitude').val(posisi.coords.longitude)
    }
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Edit Tempat Prakerin</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Tempat Prakerin</a></div>
        <div class="breadcrumb-item">Edit Tempat Prakerin</div>
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
                <form method="POST" action="{{ route('admin.prakerin.update', ['prakerin' => $prakerin->id]) }}" class="needs-validation" novalidate="">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $prakerin->nama }}" tabindex="1" required autofocus>
                    @error('nama')
                      <div class="alert alert-danger">Mohon di isi nama tempat prakerin</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama tempat prakerin
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input id="telepon" type="text" class="form-control" value="{{ $prakerin->telpon }}" name="telpon" tabindex="1" required autofocus>
                    @error('telepon')
                      <div class="alert alert-danger">Mohon di isi telepon tempat prakerin</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi telepon tempat prakerin
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-6">
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="text" class="form-control" value="{{ $prakerin->latitude }}" name="latitude" tabindex="1" required autofocus>
                        @error('latitude')
                        <div class="alert alert-danger">Mohon di isi latitude tempat prakerin</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi latitude tempat prakerin
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="longitude">Longitude</label>
                        <input id="longitude" type="text" class="form-control" name="longitude" value="{{ $prakerin->longitude }}" tabindex="1" required autofocus>
                        @error('longitude')
                        <div class="alert alert-danger">Mohon di isi longitude tempat prakerin</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi longitude tempat prakerin
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" onclick="deteksiLokasi()" class="btn btn-info w-100 mt-2">Deteksi Lokasi Otomatis</button>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $prakerin->alamat }}" tabindex="1">
                    @error('alamat')
                      <div class="alert alert-danger">Mohon di isi alamat tempat prakerin</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi alamat tempat prakerin
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Perbarui
                    </button>
                  </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection