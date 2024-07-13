@extends('layouts.app', ['title' => 'Data Tempat Praktek Kerja Industri'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

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

  $('#table-1').dataTable({
    serverSide:true,
    processing:true,
    ajax:{
      url:"{{ route('prakerin-ajax') }}"
    },
    columns:[
      {
        data:'nama',
        name:'nama'
      },
      {
        data:'telpon',
        name:'telepon'
      },
      {
        data:'latitude',
        name:'latitude'
      },
      {
        data:'longitude',
        name:'longitude'
      },
      {
        data:'action',
        name:'action'
      },
    ]
  })
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Data Tempat Praktek Kerja Industri</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Tempat Praktek Kerja Industri</div>
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
            <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah tempat</button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>          
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah tempat prakerin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.prakerin.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                    @error('nama')
                      <div class="alert alert-danger">Mohon di isi nama tempat prakerin</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama tempat prakerin
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input id="telepon" type="text" class="form-control" name="telpon" tabindex="1" required autofocus>
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
                        <input id="latitude" type="text" class="form-control" name="latitude" tabindex="1" required autofocus>
                        @error('latitude')
                        <div class="alert alert-danger">Mohon di isi latitude tempat prakerin</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi latitude tempat prakerin
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="longitude">Longitude</label>
                        <input id="longitude" type="text" class="form-control" name="longitude" tabindex="1" required autofocus>
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
                    <input id="alamat" type="text" class="form-control" name="alamat" tabindex="1">
                    @error('alamat')
                      <div class="alert alert-danger">Mohon di isi alamat tempat prakerin</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi alamat tempat prakerin
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Tambah
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

@endsection