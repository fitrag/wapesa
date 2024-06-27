@extends('layouts.app', ['title' => 'Edit Siswa'])

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
    <h1>Edit Siswa</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Edit Master</a></div>
        <div class="breadcrumb-item">Edit Siswa</div>
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
                  <form method="POST" action="{{ route('admin.siswa.update', ['siswa' => $siswa->id]) }}" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="alias">NIS</label>
                        <input id="alias" type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" tabindex="1"  required autofocus>
                        @error('nis')
                        <div class="alert alert-danger">Mohon di isi nis</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi nis
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alias">NISN</label>
                        <input id="alias" type="text" class="form-control" name="nisn" value="{{ $siswa->nisn }}" tabindex="1"  required autofocus>
                        @error('nisn')
                        <div class="alert alert-danger">Mohon di isi nisn</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi nisn
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <input id="name" type="text" class="form-control" name="nm_siswa" value="{{ $siswa->nm_siswa }}" tabindex="1"  required autofocus>
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
                            <input id="name" type="text" class="form-control" name="tmpt_lhr" value="{{ $siswa->tmpt_lhr }}" tabindex="1">
                            @error('tmpt_lhr')
                            <div class="alert alert-danger">Mohon di isi tempat lahir</div>
                            @enderror
                            <div class="invalid-feedback">
                            Mohon di isi tempat lahir
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="name">Tanggal Lahir</label>
                            <input id="tgl" type="date" class="form-control" name="tgl_lhr" value="{{ $siswa->tgl_lhr }}" tabindex="1">
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
                                <select id="level" type="level" class="form-control" name="agama" tabindex="1">
                                    <option value="">-- Pilih agama --</option>
                                    <option value="islam" {{ $siswa->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ $siswa->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="katolik" {{ $siswa->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="hindu" {{ $siswa->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="budha" {{ $siswa->agama == 'budha' ? 'selected' : '' }}>Budha</option>
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
                                <input type="radio" id="customRadio1" name="jen_kel" value="L" class="custom-control-input" {{ $siswa->jen_kel == 'L' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customRadio1">L</label>
                                </div>
                                <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="jen_kel" value="P" class="custom-control-input" {{ $siswa->jen_kel == 'P' ? 'checked' : '' }}>
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
                        <input id="name" type="text" class="form-control" name="almt_siswa" value="{{ $siswa->almt_siswa}}" tabindex="1">
                        @error('almt_siswa')
                        <div class="alert alert-danger">Mohon di isi alamat siswa</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi alamat siswa
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">No Telepon</label>
                        <input id="name" type="text" class="form-control" name="no_tlp" value="{{ $siswa->no_tlp }}" tabindex="1">
                        @error('no_tlp')
                        <div class="alert alert-danger">Mohon di isi no telepon</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi no telepon
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Ayah</label>
                        <input id="name" type="text" class="form-control" name="nm_ayah" value="{{ $siswa->nm_ayah}}" tabindex="1">
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
                                    <option value="{{$item->id}}" {{ old('kelas_id', $siswa->kelas_id)== $item->id? 'selected' : null}}>{{$item->nm_kls}}</option>
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
                                <select class="form-control" name="user_id" required="" disabled>
                                    @foreach($user as $item)
                                        <option value="{{$item->id}}" {{ old('user_id', $siswa->user_id)== $item->id? 'selected' : null}} >{{$item->name}}</option>
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