@extends('layouts.app', ['title' => 'Data User'])

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
    <h1>Data User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data User</div>
    </div>
    </div>

    <div class="section-body">
    <h2 class="section-title">Data User</h2>
    <p class="section-lead">
        Semua data user yang digunakan untuk masuk ke sistem
    </p>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        <div class="card">
            <div class="">
            <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah data user</button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Wali Kelas</th>
                    <th>Level</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->is_walas }}</td>
                            <td>{{ $user->level }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.user.delete', ['user' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-1"><i class="fas fa-trash"></i></button>
                                </form>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah data user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.user.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="name" class="form-control" name="name" tabindex="1" required autofocus>
                    @error('name')
                      <div class="alert alert-danger">Mohon di isi nama anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama anda
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
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
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
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
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon di isi password anda
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Sebagai Wali Kelas</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio1" name="is_walas" value="0" class="custom-control-input" required>
                      <label class="custom-control-label" for="customRadio1">Tidak</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio2" name="is_walas" value="1" class="custom-control-input" required>
                      <label class="custom-control-label" for="customRadio2">Iya</label>
                    </div>
                    <div class="invalid-feedback">
                      Mohon di isi walas anda
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Tambah
                    </button>
                    <input type="reset" value="Reset" class="btn btn-danger btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

@endsection