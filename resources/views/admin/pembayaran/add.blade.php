@extends('layouts.app', ['title' => 'Tambah Pembayaran'])

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
    <h1>Tambah Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Pembayaran</a></div>
        <div class="breadcrumb-item">Tambah Pembayaran</div>
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
                  <form method="POST" action="{{ route('admin.jenis-bayar.update', ['jenis_bayar' => 1]) }}" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-8 col-lg-10">
                            <input id="name" type="text" value="" placeholder="NIS/Nama Siswa" class="form-control" name="nm_jenis" tabindex="1" required autofocus>
                            @error('nm_jenis')
                                <div class="alert alert-danger">Mohon di isi nama anda</div>
                            @enderror
                            <div class="invalid-feedback">
                                Mohon di isi jenis pembayaran
                            </div>
                        </div>
                        <div class="col-4 col-lg-2">
                            <input type="submit" value="Cari" class="btn btn-primary btn-block btn-lg">
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