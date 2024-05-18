@extends('layouts.app', ['title' => 'Edit Data Tahun Pelajaran'])

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
    <h1>Edit Tahun Pelajaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Edit Tahun Pelajaran</div>
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
                <form method="POST" action="{{ route('admin.tahun-pelajaran.update', ['tahun_pelajaran' => $tahun_pelajaran->id]) }}" class="needs-validation" novalidate="">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Tahun Pelajaran</label>
                    <input id="name" type="text" class="form-control" placeholder="Contoh : 2023/2024" name="nm_tp" tabindex="1" value="{{ $tahun_pelajaran->nm_tp }}" required autofocus>
                    @error('nm_tp')
                      <div class="alert alert-danger">Mohon di isi tahun pelajaran anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi tahun pelajaran
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="semester">Semester</label>
                    <select id="semester" type="number" class="form-control" name="semester" tabindex="1" required autofocus>
                        <option value="">Pilih semester</option>
                        <option value="genap" {{ ($tahun_pelajaran->semester == 'genap') ? 'selected' : '' }}>Genap</option>
                        <option value="ganjil" {{ ($tahun_pelajaran->semester == 'ganjil') ? 'selected' : '' }}>Ganjil</option>
                    </select>
                    @error('semester')
                      <div class="alert alert-danger">Mohon di isi semester anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi semester
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" type="number" class="form-control" name="status" tabindex="1" required autofocus>
                        <option value="">Pilih status</option>
                        <option value="1" {{ ($tahun_pelajaran->status == 1) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ ($tahun_pelajaran->status == 0) ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                      <div class="alert alert-danger">Mohon di isi status anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi status
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