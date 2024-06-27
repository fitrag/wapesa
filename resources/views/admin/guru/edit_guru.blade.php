@extends('layouts.app', ['title' => 'Edit Data Guru'])

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
    <h1>Edit Data Guru</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.guru')}}">Data Guru</a></div>
        <div class="breadcrumb-item">Edit Data Guru</div>
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
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.guru.update', ['guru' => $guru->id]) }}" class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <select class="form-control" name="user_id" required="" disabled>
                            @foreach($user as $item)
                                <option value="{{$item->id}}" {{ old('user_id', $guru->user_id)== $item->id? 'selected' : null}} >{{$item->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input id="nip" type="text" class="form-control" name="nip" value="{{ $guru->nip}}" tabindex="1" required>
                        @error('nip')
                        <div class="alert alert-danger">Mohon di isi nip anda</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi nip
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nuptk">NUPTK</label>
                        <input id="nuptk" type="text" class="form-control" name="nuptk" value="{{ $guru->nuptk }}" tabindex="1" required>
                        @error('nuptk')
                        <div class="alert alert-danger">Mohon di isi nuptk anda</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi nuptk
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nm_guru">Nama</label>
                        <input id="nm_guru" type="text" class="form-control" name="nm_guru" value="{{ $guru->nm_guru}}" tabindex="1" required>
                        @error('nm_guru')
                        <div class="alert alert-danger">Mohon di isi nama anda</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi nama
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Tempat Lahir</label>
                        <input id="tmpt_lhr" type="text" class="form-control" name="tmpt_lhr" value="{{ $guru->tmpt_lhr}}" tabindex="1" required>
                        @error('tmpt_lhr')
                        <div class="alert alert-danger">Mohon di isi Tempat Lahir anda</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi Tempat Lahir
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Tanggal Lahir</label>
                            <input id="tgl" type="date" class="form-control" name="tgl_lhr" value="{{ $guru->tgl_lhr }}" tabindex="1">
                            @error('tgl_lhr')
                                <div class="alert alert-danger">Mohon di isi tanggal lahir</div>
                            @enderror
                            <div class="invalid-feedback">
                                Mohon di isi tanggal lahir
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Jenis Kelamin</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="jen_kel" value="L" class="custom-control-input" {{ $guru->jen_kel == 'L' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">L</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="jen_kel" value="P" class="custom-control-input" {{ $guru->jen_kel == 'P' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">P</label>
                        </div>
                        <div class="invalid-feedback">
                        Mohon di isi jenis kelamin
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="level">Agama</label>
                        <select id="level" type="level" class="form-control" name="agama" tabindex="1">
                            <option value="">-- Pilih agama --</option>
                            <option value="islam" {{ $guru->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                            <option value="kristen" {{ $guru->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="katolik" {{ $guru->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="hindu" {{ $guru->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="budha" {{ $guru->agama == 'budha' ? 'selected' : '' }}>Budha</option>
                        </select>
                        @error('agama')
                        <div class="alert alert-danger">Mohon di isi agama</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi agama
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Alamat</label>
                        <input id="name" type="text" class="form-control" name="almt" value="{{ $guru->almt}}" tabindex="1">
                        @error('almt')
                        <div class="alert alert-danger">Mohon di isi alamat guru</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi alamat guru
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">No Telepon</label>
                        <input id="name" type="text" class="form-control" name="no_tlp" value="{{ $guru->no_tlp }}" tabindex="1">
                        @error('no_tlp')
                        <div class="alert alert-danger">Mohon di isi no telepon</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi no telepon
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                        Tambah
                        </button>
                        
                    </div>
                    </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

        

@endsection