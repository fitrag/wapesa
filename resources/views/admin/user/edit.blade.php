@extends('layouts.app', ['title' => 'Edit User'])

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
    <h1>Edit User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data User</a></div>
        <div class="breadcrumb-item">Edit User</div>
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
                <form method="POST" action="{{ route('admin.user.update', ['user' => $user->id]) }}" class="needs-validation" novalidate="">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="name" class="form-control" value="{{ $user->name }}" name="name" tabindex="1" required autofocus>
                    @error('name')
                      <div class="alert alert-danger">Mohon di isi nama anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama anda
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" value="{{ $user->username }}" name="username" tabindex="1" required>
                    @error('username')
                      <div class="alert alert-danger">Mohon di isi username anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi username anda
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="level">Level</label>
                    <select id="level" type="level" class="form-control" name="level" tabindex="1" required>
                        <option value="">-- Pilih level user --</option>
                        <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ $user->level == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                    @error('level')
                      <div class="alert alert-danger">Mohon di isi level anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi level anda
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Sebagai Wali Kelas</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio1" name="is_walas" value="0" class="custom-control-input" {{ $user->is_walas == '0' ? 'checked' : '' }} required>
                      <label class="custom-control-label" for="customRadio1">Tidak</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio2" name="is_walas" value="1" class="custom-control-input" {{ $user->is_walas == '1' ? 'checked' : '' }} required>
                      <label class="custom-control-label" for="customRadio2">Iya</label>
                    </div>
                    <div class="invalid-feedback">
                      Mohon di isi walas anda
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