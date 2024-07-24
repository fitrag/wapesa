@extends('layouts.app', ['title' => 'Pengaturan'])

@push('scripts')

<script>
    $('#foto').change(function(e){
        $('#fotoImg').attr('src', window.URL.createObjectURL(this.files[0]))
        console.log(this.files[0].name)
    })
</script>

@endpush

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Profile : {{ auth()->user()->name }}</h1>
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
                    <form action="{{ route('profile-update', ['user' => auth()->user()->username]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <div class="mb-3 text-center">
                                <img alt="image" src="{{ auth()->user()->foto ? asset('foto/'.auth()->user()->foto) : asset('img/avatar/avatar-1.png') }}" id="fotoImg" style="width:100%" class="w-25 img-thumbnail p-3">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto" id="foto">
                                <label class="custom-file-label" for="customFile">Pilih foto</label>
                                <small class="text-muted">Maksimal ukuran file foto : 1MB</small>
                                @error('foto')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Simpan" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection