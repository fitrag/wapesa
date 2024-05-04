@extends('layouts.app', ['title' => 'Scan Kartu'])

@push('scripts')
<!-- JS Libraies -->
<script type="text/javascript" src="{{ asset('instascan.min.js') }}"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        document.getElementById('hasil').innerHTML = content
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
    console.error(e);
    });
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Scan Kartu</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Absensi</a></div>
        <div class="breadcrumb-item">Scan Kartu</div>
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
                <div class="text-center">
                    <video id="preview" class="mw-100"></video>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection