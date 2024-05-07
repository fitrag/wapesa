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
    <h1>Data Siswa</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Siswa</div>
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
              <button class="btn btn-primary float-right mx-1" data-target="#exampleModal" data-toggle="modal">Tambah data siswa</button>
              <button class="btn btn-success float-right mx-1" data-target="#importExcel" data-toggle="modal">Import via Excel</button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($siswas as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa }}</td>
                            <td>{{ $siswa}}</td>
                            <td>{{ $siswa }}</td>
                            <td>{{ $siswa }}</td>
                            <td>
                                <a href="{{ route('admin.jenis-bayar.edit', ['siswa' => $siswa->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.jenis-bayar.delete', ['siswa' => $siswa->id]) }}" method="post">
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
                <h5 class="modal-title">Tambah jenis pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.jenis-bayar.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama Jenis Pembayaran</label>
                    <input id="name" type="text" class="form-control" name="nm_jenis" tabindex="1" required autofocus>
                    @error('nm_jenis')
                      <div class="alert alert-danger">Mohon di isi nama anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi jenis pembayaran
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input id="biaya" type="number" class="form-control" name="biaya" tabindex="1" required autofocus>
                    @error('biaya')
                      <div class="alert alert-danger">Mohon di isi biaya anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi biaya
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input id="kelas" type="text" class="form-control" name="kelas" tabindex="1" required autofocus>
                    @error('kelas')
                      <div class="alert alert-danger">Mohon di isi kelas anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi kelas
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input id="keterangan" type="text" class="form-control" name="ket" tabindex="1" required autofocus>
                    @error('keterangan')
                      <div class="alert alert-danger">Mohon di isi keterangan anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi keterangan
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