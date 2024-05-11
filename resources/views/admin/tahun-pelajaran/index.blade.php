@extends('layouts.app', ['title' => 'Data Tahun Pelajaran'])

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
    <h1>Data Tahun Pelajaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Tahun Pelajaran</div>
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
            <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah tahun pelajaran</button>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Tahun Pelajaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($tahun_pelajarans as $tahun_pelajaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tahun_pelajaran->nm_tp }}</td>
                            <td>{{ ($tahun_pelajaran->status) ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <a href="{{ route('admin.tahun-pelajaran.edit', ['tahun_pelajaran' => $tahun_pelajaran->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.tahun-pelajaran.delete', ['tahun_pelajaran' => $tahun_pelajaran->id]) }}" method="post">
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
                <h5 class="modal-title">Tambah tahun pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.tahun-pelajaran.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="name">Tahun Pelajaran</label>
                    <input id="name" type="text" class="form-control" placeholder="Contoh : 2023/2024" name="nm_tp" tabindex="1" required autofocus>
                    @error('nm_tp')
                      <div class="alert alert-danger">Mohon di isi tahun pelajaran anda</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi tahun pelajaran
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" type="number" class="form-control" name="status" tabindex="1" required autofocus>
                        <option value="">Pilih status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
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