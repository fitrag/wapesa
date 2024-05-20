@extends('layouts.app', ['title' => 'Pengaturan'])

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
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-4">
                            <form action="{{ route('pengaturan-update',['id' => 1 ]) }}" method="post">
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
                            </form>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <center>
                                <img src="{{ asset('img/'.$pengaturan->foto) }}" alt="Logo sekolah" class="w-75 img-thumbnail p-3">
                            </center>
                            <div class="mb-3 mt-3">
                                <label for="formFile" class="form-label">Logo sekolah</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection