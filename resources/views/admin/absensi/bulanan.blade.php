@extends('layouts.app', ['title' => 'Absensi Bulanan'])

@php
    $month = request()->bulan ? date_format(date_create(request()->bulan), 't') : date('t')
@endphp

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Absensi Bulanan</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Absensi</a></div>
          <div class="breadcrumb-item">Absensi Bulanan</div>
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
                <form action="{{ route('absensi-bulanan') }}" method="get">
                    <div class="row align-items-center">
                        <div class="mb-3 col-lg-10">
                            <label for="" class="form-label">Bulan Absensi</label>
                            <input type="month" name="bulan" value="{{ request()->bulan ? request()->bulan : date('Y-m') }}" class="form-control">
                        </div>
                        <div class="col-lg-2 mb-3">
                            <input type="submit" value="Lihat" class="btn btn-primary btn-md w-100">
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">NO</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="{{ $month }}" class="text-center">Tanggal</th>
                                <th colspan="5" class="text-center">Total</th>
                            </tr>
                            <tr>
                                @for($i=1;$i<=$month;$i++)
                                <th class="text-center">{{ $i }}</th>
                                @endfor
                                <th>H</th>
                                <th>I</th>
                                <th>S</th>
                                <th>A</th>
                                <th>AL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswas as $siswa)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nm_siswa }}</td>
                                @for($i=1;$i<=$month;$i++)
                                    <td class="text-center text-uppercase">
                                        @foreach($siswa->absensis as $absen)
                                            @if(date_format(date_create($absen->created_at), 'd') == $i)
                                                {{ $absen->hadir }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endfor
                                <td>{{ $siswa->absensis->where('hadir','h')->count() }}</td>
                                <td>{{ $siswa->absensis->where('hadir','i')->count() }}</td>
                                <td>{{ $siswa->absensis->where('hadir','s')->count() }}</td>
                                <td>{{ $siswa->absensis->where('hadir','a')->count() }}</td>
                                <td>{{ $siswa->absensis->where('hadir','al')->count() }}</td>
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