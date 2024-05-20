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
    <h1>Data Wali Kelas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Wali Kelas</div>
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
            <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah</button>
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
                    <th>Kelas</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($wali_kelass as $wali_kelas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $wali_kelas->user->name }}</td>
                            <td>{{ $wali_kelas->kelas->nm_kls }}</td>
                            <td>
                                <form action="{{ route('admin.wali-kelas.delete', ['wali_kelas' => $wali_kelas->id]) }}" method="post">
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
                <h5 class="modal-title">Tambah wali kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.wali-kelas.store') }}" class="needs-validation" novalidate="">
                  @csrf
                    <div class="form-row">
                      <div class="col-lg-6 mb-3">
                          <label for="" class="form-label">Guru</label>
                          <select name="user_id" class="form-control">
                              <option value="">Pilih Guru</option>
                              @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                          <label for="" class="form-label">Kelas</label>
                          <select name="kelas_id" class="form-control">
                              <option value="">Pilih Kelas</option>
                              @foreach($kelass as $kelas)
                              <option value="{{ $kelas->id }}">{{ $kelas->nm_kls }}</option>
                              @endforeach
                            </select>
                            @error('kelas_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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