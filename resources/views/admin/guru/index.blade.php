@extends('layouts.app', ['title' => 'Data Guru'])

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
    <h1>Data Guru</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Guru</div>
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
            <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah guru</button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>NUPTK</th>
                    <th>Sebagai Wali Kelas</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($gurus as $guru)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guru->user->username }}</td>
                            <td>{{ $guru->nm_guru }}</td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->nuptk }}</td>
                            <td>{{ ($guru->user->is_walas) ? 'Iya' : 'Tidak' }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['user' => $guru->user->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.guru.delete', ['guru' => $guru->id]) }}" method="post">
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
                <h5 class="modal-title">Tambah guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.guru.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    @error('username')
                      <div class="alert alert-danger">Mohon di isi username anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi username
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input id="nip" type="text" class="form-control" name="nip" tabindex="1" required>
                    @error('nip')
                      <div class="alert alert-danger">Mohon di isi nip anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nip
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nuptk">NUPTK</label>
                    <input id="nuptk" type="text" class="form-control" name="nuptk" tabindex="1" required>
                    @error('nuptk')
                      <div class="alert alert-danger">Mohon di isi nuptk anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nuptk
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required>
                    @error('nama')
                      <div class="alert alert-danger">Mohon di isi nama anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="is_walas">Sebagai Wali Kelas</label>
                    <select id="is_walas" type="text" class="form-control" name="is_walas" tabindex="1" required>
                        <option value="">-- Pilih --</option>
                        <option value="1">Iya</option>
                        <option value="0">Tidak</option>
                    </select>
                    @error('is_walas')
                      <div class="alert alert-danger">Mohon di isi wali kelas anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi is_walas
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="alert alert-info">Password akan digenerate dari username</div>
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