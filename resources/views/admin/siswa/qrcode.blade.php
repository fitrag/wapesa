@extends('layouts.app', ['title' => 'QRCODE - '.$siswa->nm_siswa])

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    $(document).ready(function() {


        var element = $("#html-content-holder");
        $("#btn-Preview-Image").on('click', function() {
            html2canvas(element[0],
            {
                allowTaint: true,
                useCORS: true,
                scale: 10,
            }
            ).then((canvas) => {
            const image = canvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.download = '{{ $siswa->nm_siswa }}-QrCode.png';
            link.href = image;
            link.click();
        });
        });

    });
</script>

@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Generate QRCode</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.siswa') }}">Data Siswa</a></div>
        <div class="breadcrumb-item">Generate QRCode</div>
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
              <div class="card-body" style="display:flex;justify-content:center;flex-direction:column;align-items:center">
                <div id="html-content-holder" style="background:url('{{ asset('img/bg-qrcode.jpeg') }}');background-size:cover;margin:5px 6px;padding:10px;width:5cm;height:8cm;border:none !important">
                    <center>
                        <h4 style="color:white;font-size:14px">
                            SMKN 1 Way Pengubuan
                        </h4>
                        <img src="{{ asset('img/avatar/avatar-1.png') }}" alt="" style="width:50px;border-radius:100%">
                        <p><div style="background:white;padding:9px;border-radius:10px;display:inline-block;margin-top:-5px">{!! $qrCode !!}</div></p>
                        <div>
                            <p style="font-size:12px;margin-top:-10px !important">
                                Nama : {{ $siswa->nm_siswa }}
                            </p>
                            <p style="font-size:12px;margin-top:-25px !important">
                                NIS : {{ $siswa->nis }}
                            </p>
                        </div>
                    </center>
                </div>
                <input download="download.png" id="btn-Preview-Image" type="button" class="btn btn-primary btn-lg w-100 mt-3" value="Download" />
              </div>
          </div>
          </div>
      </div>
    </div>
</section>

       

@endsection