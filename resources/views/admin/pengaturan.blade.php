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
                                        <input type="submit" value="Simpan" class="btn btn-primary w-100">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                    <center>
                                        <img src="{{ asset('img/'.$pengaturan->logo) }}" alt="Logo sekolah" id="logoImg" class="w-75 img-thumbnail p-3">
                                    </center>
                                    <div class="mb-3 mt-3">
                                        <label for="formFile" class="form-label">Logo sekolah</label>
                                        <input class="form-control" type="file" name="logo" id="logo">
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        Coming Soon
                      </div>
                      <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                        Coming Soon
                      </div>
                </div>
            </div>
        </div>
    </section>

@endsection