@extends('layouts.app', ['title' => 'Tambah Jurnal Mapel'])

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
    <h1>Tambah Jurnal Mapel</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Pilih Kelas</a></div>
        <div class="breadcrumb-item"> <a href="#">Tambah Jurnal Mapel</a></div>
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
                <form method="POST" action="{{ route('admin.jurnal-guru.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(Auth::user()->level === "admin")
                        <div class="form-group">
                            <label for="alias">Nama Guru</label>
                            <select class="form-control" name="guru_id">
                                < @foreach($guru as $item)
                                    <option value="{{$item->kon_id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    @else
                        <div class="form-group">
                            <label for="alias">Nama Guru</label>
                            <select class="form-control" name="guru_id">
                                <option value="{{ $guru_id->id }}">{{ $guru_id->nm_guru}}</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="alias">Mata Pelajaran</label>
                        <select class="form-control" name="mapel_id">
                            @foreach($mapel as $item)
                                <option value="{{$item->mapel_id}}">{{$item->alias}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alias">Kelas</label>
                        <select class="form-control" name="kelas_id">
                            @foreach($kelas as $item)
                                <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alias">Tahun Pelajaran</label>
                        <select class="form-control" name="tp_id">
                            @foreach($tp as $item)
                                <option value="{{$item->id}}">{{$item->nm_tp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tanggal</label>
                        <input id="tgl" type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl" tabindex="1"  required autofocus>
                        @error('tgl')
                        <div class="alert alert-danger">Mohon di isi tanggal</div>
                        @enderror
                        <div class="invalid-feedback">
                        Mohon di isi tanggal 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Jam Ke</label>
                        <input id="jamke" type="text" class="form-control"  name="jamke" value="{{ old('jamke') }}"  placeholder="contoh: 1 - 3">
                        @error('jamke')
                            <div class="alert alert-danger">Mohon di isi Jam Ke</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi Jam Ke 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Kompetensi dasar / materi pokok / sub materi</label>
                        <textarea name="materi" class="form-control" id="" cols="30" rows="6" >{{ old('materi') }}</textarea>
                        @error('materi')
                            <div class="alert alert-danger">Mohon di isi materi</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi materi 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Pertemuan Ke (contoh: 1 )</label>
                        <input id="tmke" type="number" class="form-control"  name="tmke" value="{{ old('tmke') }}">
                        @error('tmke')
                            <div class="alert alert-danger">Mohon di isi pertemuan ke</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi pertemuan ke 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Selesai/tidak selesai, alasan</label>
                        <textarea name="status" class="form-control" id="" cols="30" rows="6">{{ old('status') }}</textarea>
                        @error('status')
                            <div class="alert alert-danger">Mohon di isi selesai/tidak selesai</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi selesai/tidak selesai 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Absensi (contoh: Nihil / Anis (S) / Adi (I))</label>
                        <textarea name="absensi" class="form-control" id="" cols="30" rows="6">{{ old('absensi') }}</textarea>
                        @error('absensi')
                            <div class="alert alert-danger">Mohon di isi absensi</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi absensi 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Keterangan (contoh: Alpha lari jam ke-4 / di kosongkan)</label>
                        <textarea name="ket" class="form-control" id="" cols="30" rows="6">{{ old('ket') }}</textarea>
                        @error('ket')
                            <div class="alert alert-danger">Mohon di isi keterangan</div>
                        @enderror
                        <div class="invalid-feedback">
                            Mohon di isi keterangan 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-left mr-1" id="submit">
                                Go
                    </button>
                    <a href="{{route('admin.jurnal-guru')}}" class="btn btn-dark pull-left">Back</a>
                            
                        
                </form>
                
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection