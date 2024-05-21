@extends('layouts.app', ['title' => 'Absensi Tahun Pelajaran'])

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Absensi Tahun Pelajaran</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Absensi</a></div>
          <div class="breadcrumb-item">Absensi Tahun Pelajaran</div>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">NO</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="5" class="text-center">Keterangan</th>
                            </tr>
                            <tr>
                                <th class="text-center">H</th>
                                <th class="text-center">I</th>
                                <th class="text-center">S</th>
                                <th class="text-center">A</th>
                                <th class="text-center">AL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswas as $siswa)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nm_siswa }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereHadir('h')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereHadir('i')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereHadir('s')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereHadir('a')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereHadir('al')->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada siswa</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection