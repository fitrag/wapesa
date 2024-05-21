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
                                <th rowspan="3" class="text-center">NO</th>
                                <th rowspan="3" class="text-center">Nama</th>
                                <th colspan="10" class="text-center text-white bg-dark">Keterangan</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center text-white bg-primary">Ganjil</th>
                                <th colspan="5" class="text-center text-white bg-primary">Genap</th>
                            </tr>
                            <tr>
                                <th class="text-center text-white bg-success">H</th>
                                <th class="text-center text-white bg-info">I</th>
                                <th class="text-center text-white bg-warning">S</th>
                                <th class="text-center text-white bg-danger">A</th>
                                <th class="text-center text-white bg-danger">AL</th>
                                <th class="text-center text-white bg-success">H</th>
                                <th class="text-center text-white bg-info">I</th>
                                <th class="text-center text-white bg-warning">S</th>
                                <th class="text-center text-white bg-danger">A</th>
                                <th class="text-center text-white bg-danger">AL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswas as $siswa)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nm_siswa }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('h')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('h')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('i')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('i')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('s')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('s')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('a')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('a')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('al')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('ganjil')->whereHadir('al')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('h')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('h')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('i')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('i')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('s')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('s')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('a')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('a')->count() }}</td>
                                <td align="center">{{ $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('al')->count() == 0 ? '-' : $siswa->absensis()->whereTpId($tp->id)->whereSemester('genap')->whereHadir('al')->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">Belum ada siswa</td>
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