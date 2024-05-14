@extends('layouts.app', ['title' => 'Data Jenis Bayar'])

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
    <h1>Edit Jenis Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Edit Jenis Pembayaran</div>
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
                  <form method="POST" action="{{ route('admin.jenis-bayar.update', ['jenis_bayar' => $jenis_bayar->id]) }}" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="name">Nama Jenis Pembayaran</label>
                      <input id="name" type="text" value="{{ $jenis_bayar->nm_jenis }}" class="form-control" name="nm_jenis" tabindex="1" required autofocus>
                      @error('nm_jenis')
                        <div class="alert alert-danger">Mohon di isi nama anda</div>
                      @enderror
                      <div class="invalid-feedback">
                        Mohon di isi jenis pembayaran
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="biaya">Biaya</label>
                      <input id="biaya" type="number" value="{{ $jenis_bayar->biaya }}" class="form-control" name="biaya" tabindex="1" required autofocus>
                      @error('biaya')
                        <div class="alert alert-danger">Mohon di isi biaya anda</div>
                      @enderror
                      <div class="invalid-feedback">
                        Mohon di isi biaya
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kelas">Kelas</label>
                      <input id="kelas" type="text" value="{{ $jenis_bayar->kelas }}" class="form-control" name="kelas" tabindex="1" required autofocus>
                      @error('kelas')
                        <div class="alert alert-danger">Mohon di isi kelas anda</div>
                      @enderror
                      <div class="invalid-feedback">
                        Mohon di isi kelas
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <input id="keterangan" type="text" class="form-control" value="{{ $jenis_bayar->ket }}" name="ket" tabindex="1" required autofocus>
                      @error('keterangan')
                        <div class="alert alert-danger">Mohon di isi keterangan anda</div>
                      @enderror
                      <div class="invalid-feedback">
                        Mohon di isi keterangan
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