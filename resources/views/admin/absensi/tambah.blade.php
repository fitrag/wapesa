@extends('layouts.app', ['title' => 'Tambah Absensi'])

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Tambah Absensi</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Absensi</a></div>
          <div class="breadcrumb-item">Tambah Absensi</div>
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
                <form action="{{ route('absensi-tambah') }}" method="get">
                    <div class="row align-items-center">
                        <div class="mb-3 col-lg-10">
                            <label for="" class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelass as $kelas)
                                    <option value="{{ $kelas->id }}" {{ (request()->kelas_id == $kelas->id) ? 'selected' : '' }}>{{ $kelas->nm_kls }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <span class="text-danger">Kelas belum dipilih</span>
                            @enderror
                        </div>
                        <div class="col-lg-2 mb-3">
                            <input type="submit" value="Lihat" class="btn btn-primary btn-md w-100">
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <form action="{{ (App\Models\Absensi::whereKelasId(request()->kelas_id)->whereDate('created_at',now())->count() != App\Models\Siswa::whereKelasId(request()->kelas_id)->count()) ? route('absensi-store') : '/absensi/edit' }}" method="post">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ request()->kelas_id ? request()->kelas_id : ''  }}">
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siswas as $siswa)
                                    <input type="hidden" name="user_id[]" value="{{ $siswa->user->id }}">
                                    <input type="hidden" name="nis[]" value="{{ $siswa->nis }}">
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->nm_siswa }}</td>
                                            <td class="text-uppercase text-center">{{ $siswa->absensis()->whereDate('created_at', date('Y-m-d'))->first() ? $siswa->absensis()->whereDate('created_at', date('Y-m-d'))->first()?->hadir : 'Belum absen' }}</td>
                                            <td>
                                                <select name="hadir[]" id="" class="form-control">
                                                @if ($siswa->absensis)
                                                    @if ($siswa->absensis()?->whereDate('created_at', date('Y-m-d'))->first()?->hadir == 'h')
                                                        <option value="h" selected>Hadir</option>
                                                    @elseif ($siswa->absensis()?->whereDate('created_at', date('Y-m-d'))->first()?->hadir == 'i')
                                                        <option value="i" selected>Izin</option>
                                                    @elseif ($siswa->absensis()?->whereDate('created_at', date('Y-m-d'))->first()?->hadir == 's')
                                                        <option value="s" selected>Sakit</option>
                                                    @elseif ($siswa->absensis()?->whereDate('created_at', date('Y-m-d'))->first()?->hadir == 'a')
                                                        <option value="a" selected>Alpha</option>
                                                    @elseif ($siswa->absensis()?->whereDate('created_at', date('Y-m-d'))->first()?->hadir == 'al')
                                                        <option value="al" selected>Alpha Lari</option>
                                                    @endif
                                                @endif
                                                    <option value="">Pilih keterangan</option>
                                                    <option value="h">Hadir</option>
                                                    <option value="i">Izin</option>
                                                    <option value="s">Sakit</option>
                                                    <option value="a">Alpha</option>
                                                    <option value="al">Alpha Lari</option>
                                                </select>
                                                @error('hadir.*')
                                                    <span class="text-danger my-1">Keterangan harus dipilih</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if(request()->kelas_id)
                            <input type="submit" value="Simpan" class="btn btn-primary w-100">
                        @endif
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection