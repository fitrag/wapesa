@extends('layouts.app', ['title' => 'Data Siswa'])

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Absensi Harian</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Absensi</a></div>
          <div class="breadcrumb-item">Absensi Harian</div>
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
                <form action="{{ route('absensi-harian') }}" method="get">
                    <div class="row align-items-center">
                        <div class="mb-3 col-lg-10">
                            <label for="" class="form-label">Tanggal Absensi</label>
                            <input type="date" name="tanggal" value="{{ request()->tanggal ? request()->tanggal : date('Y-m-d') }}" class="form-control">
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
                                @if($siswa->absensis)
                                    @foreach($siswa->absensis as $keterangan)
                                        <td align="center">{{ $keterangan->hadir == 'h' ? '✅' : '' }}</td>
                                        <td align="center">{{ $keterangan->hadir == 'i' ? '✅' : '' }}</td>
                                        <td align="center">{{ $keterangan->hadir == 's' ? '✅' : '' }}</td>
                                        <td align="center">{{ $keterangan->hadir == 'a' ? '✅' : '' }}</td>
                                        <td align="center">{{ $keterangan->hadir == 'al' ? '✅' : '' }}</td>
                                    @endforeach
                                @endif
                                @if($siswa->absensis->isEmpty())
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada siswa</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td align="center" colspan="2" rowspan="3" class="font-weight-bold">TOTAL</td>
                                <td align="center">H</td>
                                <td align="center">I</td>
                                <td align="center">S</td>
                                <td align="center">A</td>
                                <td align="center">AL</td>
                            </tr>
                            <tr>
                                <td align="center">{{ $absensis->where('hadir','h')->count() }}</td>
                                <td align="center">{{ $absensis->where('hadir','i')->count() }}</td>
                                <td align="center">{{ $absensis->where('hadir','s')->count() }}</td>
                                <td align="center">{{ $absensis->where('hadir','a')->count() }}</td>
                                <td align="center">{{ $absensis->where('hadir','al')->count() }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center" style="font-weight:bold;font-size:18px">{{ $absensis->where('hadir','h')->count() + $absensis->where('hadir','i')->count() + $absensis->where('hadir','s')->count() + $absensis->where('hadir','a')->count() + $absensis->where('hadir','al')->count() }}</td>
                            </tr>
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