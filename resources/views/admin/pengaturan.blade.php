@extends('layouts.app', ['title' => 'Pengaturan'])

@push('scripts')

<script>
    $('#logo').change(function(e){
        $('#logoImg').attr('src', window.URL.createObjectURL(this.files[0]))
        console.log(this.files[0].name)
    })
</script>

@endpush

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Pengaturan</h1>
        </div>

        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Website</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Sinkronisasi</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Soon</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">    
                        <div class="d-lg-flex align-items-center flex-lg-row flex-md-row-reverse">
                            <div class="col-lg-6 mb-4">
                                    <form action="{{ route('pengaturan-update',['id' => 1 ]) }}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama Aplikasi</label>
                                            <input type="text" name="nama_aplikasi" value="{{ $pengaturan?->nama_aplikasi }}" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama Sekolah</label>
                                            <input type="text" name="nama_sekolah" value="{{ $pengaturan?->nama_sekolah }}" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">NPSN</label>
                                            <input type="text" name="npsn" value="{{ $pengaturan?->npsn }}" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Alamat Sekolah</label>
                                            <textarea name="alamat_sekolah" class="form-control">{{ $pengaturan?->alamat_sekolah }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Fitur Absen di Dashboard Siswa?</label>
                                            <select name="siswa_absen" id="" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="0" {{ !$pengaturan?->siswa_absen ? 'selected' : '' }}>Tidak aktif</option>
                                                <option value="1" {{ $pengaturan?->siswa_absen ? 'selected' : '' }}>Aktif</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Kelas berapa yang bisa absen?</label>
                                            <select name="kelas_absen" id="" class="form-control">
                                                <option value="">-- Pilih Kelas --</option>
                                                <option value="X" {{ $pengaturan?->kelas_absen == 'X' ? 'selected' : '' }}>X</option>
                                                <option value="XI" {{ $pengaturan?->kelas_absen == 'XI' ? 'selected' : '' }}>XI</option>
                                                <option value="XII" {{ $pengaturan?->kelas_absen == 'XII' ? 'selected' : '' }}>XII</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Radius absensi</label>
                                            <input type="text" name="radius" value="{{ $pengaturan?->radius }}" class="form-control">
                                        </div>
                                        <input type="submit" value="Simpan" class="btn btn-primary w-100">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                    <center>
                                        <img src="{{ asset('img/'.$pengaturan?->logo) }}" alt="Logo sekolah" id="logoImg" class="w-75 img-thumbnail p-3">
                                    </center>
                                    <div class="mb-3 mt-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" id="logo">
                                            <label class="custom-file-label" for="customFile">Pilih logo</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        <form action="{{ route('pengaturan-sinkronisasi',['id' => 1 ]) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label">URL Server Tujuan</label>
                                <input type="text" name="url_server" placeholder="https://" value="{{ $pengaturan?->url_server }}" class="form-control">
                                <small>Isi dengan domain server tujuan sinkronisasi</small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">API Key</label>
                                <input type="text" name="api_key" value="{{ $pengaturan?->api_key }}" placeholder="--------" class="form-control">
                                <small><strong>Note :</strong> API key di generate dari website server tujuan</small>
                            </div>
                            <input type="submit" value="Simpan" class="btn btn-primary">
                        </form>
                      </div>
                      <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                        Comingsoon
                      </div>
                </div>
            </div>
        </div>
    </section>

@endsection