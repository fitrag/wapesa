@extends('layouts.app', ['title' => 'Data Kelas'])

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
    <h1>Data Kelas</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Data Kelas</div>
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
              <button class="btn btn-primary float-right mb-4" data-target="#exampleModal" data-toggle="modal">Tambah data kelas</button>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                  <thead>                                 
                      <tr>
                          <th class="text-center">#</th>
                          <th>Nama Kelas</th>
                          <th>Alias</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>                                 
                  @foreach($kelas as $kls)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $kls->nm_kls }}</td>
                              <td>{{ $kls->alias }}</td>
                              <td>
                                <div class="btn-group">
                                  <a href="{{ route('admin.kelas.edit', ['kela' => $kls->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                  <form action="{{ route('admin.kelas.delete', ['kela' => $kls->id]) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger m-1"><i class="fas fa-trash"></i></button>
                                  </form>

                                </div>
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
                <h5 class="modal-title">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.kelas.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama Kelas</label>
                    <input id="name" type="text" class="form-control" name="nm_kls" tabindex="1" placeholder="contoh: X RPL 1" required autofocus>
                    @error('nm_kls')
                      <div class="alert alert-danger">Mohon di isi nama kelas</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama kelas
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="alias">Alias</label>
                    <input id="alias" type="text" class="form-control" name="alias" tabindex="1" placeholder="contoh: X" required autofocus>
                    @error('alias')
                      <div class="alert alert-danger">Mohon di isi alias</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi alias
                    </div>
                  </div>
                  
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Tambah
                      </button>
                      <input type="reset" value="Reset" class="btn btn-danger btn-lg btn-block">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

@endsection