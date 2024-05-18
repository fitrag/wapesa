@extends('layouts.app', ['title' => 'QRCODE - '.$siswa->nm_siswa])

@push('scripts')

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
                <div class="row items-center justify-content-center">
                    <div class="col-lg-3 mb-3" style="width:150px">
                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="w-100">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <table class="table table-bordered">
                            <tr>
                                <td>NISN</td>
                                <td>{{ $siswa->nisn }}</td>
                            </tr>
                            <tr>
                                <td>NIS</td>
                                <td>{{ $siswa->nis }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $siswa->nm_siswa }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>{{ $siswa->kelas->nm_kls }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <center>{!! $qrCode !!}</center>
                    </div>
                </div>
              </div>
          </div>
          </div>
      </div>
    </div>
</section>

       

@endsection