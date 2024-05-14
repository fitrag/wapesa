@extends('layouts.app', ['title' => 'Data Siswa'])

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
              <a href="{{ url('')}}/format/siswa.xlsx"  class="btn btn-info float-right mx-1"><i class="fa fa-download"></i>Download Format</a>
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
                    <th>Username</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>                                 
                    @foreach($siswas as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nisn}}</td>
                            <td>{{ $siswa->nm_siswa }}</td>
                            <td>{{ $siswa->kelas->nm_kls }}</td>
                            <td>{{ $siswa->user->username }}</td>
                            <td>
                              <div class="btn-group">
                                <a href="{{ route('admin.siswa.edit', ['siswa' => $siswa->id]) }}" class="btn btn-primary m-1"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.siswa', ['siswa' => $siswa->id]) }}" method="post">
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
                <h5 class="modal-title">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.siswa.store') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="alias">NIS</label>
                    <input id="alias" type="text" class="form-control" name="nis" tabindex="1"  required autofocus>
                    @error('nis')
                      <div class="alert alert-danger">Mohon di isi nis</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nis
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alias">NISN</label>
                    <input id="alias" type="text" class="form-control" name="nisn" tabindex="1"  required autofocus>
                    @error('nisn')
                      <div class="alert alert-danger">Mohon di isi nisn</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nisn
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Siswa</label>
                    <input id="name" type="text" class="form-control" name="nm_siswa" tabindex="1"  required autofocus>
                    @error('nm_siswa')
                      <div class="alert alert-danger">Mohon di isi nama siswa</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama siswa
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-8">
                        <label for="name">Tempat Lahir</label>
                        <input id="name" type="text" class="form-control" name="tmpt_lhr" tabindex="1"  required autofocus>
                        @error('tmpt_lhr')
                          <div class="alert alert-danger">Mohon di isi tempat lahir</div>
                        @enderror
                        <div class="invalid-feedback">
                          Mohon di isi tempat lahir
                        </div>
                      </div>
                      <div class="col-4">
                        <label for="name">Tanggal Lahir</label>
                          <input id="tgl" type="date" class="form-control" name="tgl_lhr" tabindex="1"  required autofocus>
                          @error('tgl_lhr')
                            <div class="alert alert-danger">Mohon di isi tanggal lahir</div>
                          @enderror
                          <div class="invalid-feedback">
                            Mohon di isi tanggal lahir
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="form-group">
                        <label for="level">Agama</label>
                        <select id="level" type="level" class="form-control" name="agama" tabindex="1" required>
                            <option value="">-- Pilih agama --</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="hindu">Hindu</option>
                            <option value="budha">Budha</option>
                        </select>
                        @error('agama')
                          <div class="alert alert-danger">Mohon di isi agama</div>
                        @enderror
                        <div class="invalid-feedback">
                          Mohon di isi agama
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="d-block">
                          <label for="password" class="control-label">Jenis Kelamin</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio1" name="jen_kel" value="l" class="custom-control-input" required>
                          <label class="custom-control-label" for="customRadio1">L</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio2" name="jen_kel" value="p" class="custom-control-input" required>
                          <label class="custom-control-label" for="customRadio2">P</label>
                        </div>
                        <div class="invalid-feedback">
                          Mohon di isi jenis kelamin
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Alamat</label>
                    <input id="name" type="text" class="form-control" name="almt_siswa" tabindex="1"  required autofocus>
                    @error('almt_siswa')
                      <div class="alert alert-danger">Mohon di isi alamat siswa</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi alamat siswa
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">No Telepon</label>
                    <input id="name" type="text" class="form-control" name="no_tlp" tabindex="1"  required autofocus>
                    @error('no_tlp')
                      <div class="alert alert-danger">Mohon di isi no telepon</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi no telepon
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Aayah</label>
                    <input id="name" type="text" class="form-control" name="nm_ayah" tabindex="1"  required autofocus>
                    @error('nm_ayah')
                      <div class="alert alert-danger">Mohon di isi nama ayah</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi nama ayah
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="name">Nama Kelas</label>
                        <select class="form-control" name="kelas_id" required="">
                            @foreach($kelas as $item)
                                <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                            @endforeach
                        </select>
                        @error('id_kls')
                          <div class="alert alert-danger">Mohon di isi nama kelas</div>
                        @enderror
                        <div class="invalid-feedback">
                          Mohon di isi kelas
                        </div>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <label for="name">Nama user (Jika tidak ada silahkan input di data user)</label>
                        <select class="form-control" name="user_id" required="">
                            @foreach($user as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                          <div class="alert alert-danger">Mohon di isi nama user</div>
                        @enderror
                        <div class="invalid-feedback">
                          Mohon di isi nama user
                        </div>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="importExcel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Import data via excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.siswa.import') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="name">Pilih file</label>
                    <input id="file" type="file" class="form-control" name="file" tabindex="1" required>
                    @error('file')
                      <div class="alert alert-danger">Mohon di filenya</div>
                    @enderror
                    <div class="invalid-feedback">
                      Mohon di isi filenya
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