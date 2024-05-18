@extends('layouts.app', ['title' => 'Scan Kartu'])

@push('scripts')
<!-- JS Libraies -->
<script type="text/javascript" src="{{ asset('instascan.min.js') }}"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    var videoSelect = document.querySelector('select#videoSource');
    scanner.addListener('scan', function (content) {
        $.ajax({
            url:"{{ route('scanning-absensi') }}",
            type:"POST",
            data:{
                '_token':"{{ @csrf_token() }}",
                'siswa':content
            },
            success:function(e){
                const data = JSON.parse(e)
                const statusCode = data.statusCode
                if(statusCode === 200){
                    $('#berhasilAlert').removeClass('d-none')
                    $('#gagalAlert').addClass('d-none')
                    berhasilAudio();
                    document.getElementById('hasil').innerHTML = data.data.nis
                    document.getElementById('nama').innerHTML = data.data.nm_siswa
                }else if(statusCode === 404){
                    $('#berhasilAlert').addClass('d-none')
                    $('#gagalAlert').removeClass('d-none')
                    gagalAudio();
                    $('#gagalAlert').show()
                    document.getElementById('hasil').innerHTML = 'Data tidak ditemukan'
                    document.getElementById('nama').innerHTML = 'Data tidak ditemukan'
                }else{
                    $('#berhasilAlert').addClass('d-none')
                    $('#gagalAlert').removeClass('d-none')
                    sudahAudio();
                    document.getElementById('hasil').innerHTML = 'Sudah absen'
                    document.getElementById('nama').innerHTML = 'Sudah absen'
                }
            }
        })
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

    $("#inputAbsen").submit(function(e){
        e.preventDefault();
        if($('#nis').length != 0){
            $.ajax({
                url:"{{ route('scanning-absensi') }}",
                type:"POST",
                data:{
                    '_token':"{{ @csrf_token() }}",
                    'siswa':$('#nis').val()
                },
                success:function(e){
                    const data = JSON.parse(e)
                    const statusCode = data.statusCode
                    if(statusCode === 200){
                        $('#berhasilAlert').removeClass('d-none')
                        $('#gagalAlert').addClass('d-none')
                        berhasilAudio();
                        $('#nis').val('')
                        document.getElementById('hasil').innerHTML = data.data.nis
                        document.getElementById('nama').innerHTML = data.data.nm_siswa
                    }else if(statusCode === 404){
                        $('#berhasilAlert').addClass('d-none')
                        $('#gagalAlert').removeClass('d-none')
                        gagalAudio();
                        $('#nis').val('')
                        document.getElementById('hasil').innerHTML = 'Data tidak ditemukan'
                        document.getElementById('nama').innerHTML = 'Data tidak ditemukan'
                    }else{
                        $('#berhasilAlert').addClass('d-none')
                        $('#gagalAlert').removeClass('d-none')
                        $('#nis').val('')
                        sudahAudio();
                        document.getElementById('hasil').innerHTML = 'Sudah absen'
                        document.getElementById('nama').innerHTML = 'Sudah absen'
                    }
                }
            })
        }
    })

    function berhasilAudio() {
        var x = document.getElementById("berhasil");
        x.play();
    }
    function gagalAudio() {
        var x = document.getElementById("gagal");
        x.play();
    }
    function sudahAudio() {
        var x = document.getElementById("sudah");
        x.play();
    }
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

    <audio id="berhasil">
        <source src="{{asset('sound/berhasil.mp3')}}" type="audio/mpeg">
    </audio> 
    <audio id="gagal">
        <source src="{{asset('sound/gagal.mp3')}}" type="audio/mpeg">
    </audio> 
    <audio id="sudah">
        <source src="{{asset('sound/sudah.mp3')}}" type="audio/mpeg">
    </audio> 
    <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="alert alert-success d-none" id="berhasilAlert">Berhasil absen</div>
            <div class="alert alert-danger d-none" id="gagalAlert">Gagal absen</div>
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <video id="preview" class="mw-100"></video>
                </div>
                <div class="my-2">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td><span id="nama"></span></td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td><span id="hasil"></span></td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="mt-4 p-4 border-top">
                <h5 class="mb-3">Input Absen Manual</h5>
                <form action="" method="post" id="inputAbsen">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" name="nis" id="nis" placeholder="Masukkan NIS" class="form-control">
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

@endsection