@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            @if(auth()->user()->level == 'admin' || auth()->user()->is_kepsek)
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Guru</h4>
                    </div>
                    <div class="card-body">
                        {{ App\Models\User::where('level','guru')->count() }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Siswa</h4>
                    </div>
                    <div class="card-body">
                            {{ App\Models\User::where('level','siswa')->count() }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kelas</h4>
                    </div>
                    <div class="card-body">
                        {{ App\Models\Kelas::count() }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Mapel</h4>
                    </div>
                    <div class="card-body">
                        {{ App\Models\Mapel::count() }}
                    </div>
                    </div>
                </div>
                </div>                  
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Data Wali Kelas</h4>
                        <div class="card-header-action">
                            <!--<a href="{{ route('siswa-pembayaran') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>-->
                        </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                <tbody><tr>
                                    <th>Nama</th>
                                    <th>Wali Kelas</th>
                                </tr>
                                @forelse($walikelass as $walikelas)
                                <tr>
                                    <th>{{ $walikelas->user->name }}</th>
                                    <th>{{ $walikelas->kelas->nm_kls }}</th>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Belum ada data</td>
                                </tr>
                                @endforelse
                                </tbody></table>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Biaya Sekolah Tahun Ajaran {{ App\Models\Tp::whereStatus(1)->first()?->nm_tp }}</h4>
                        <div class="card-header-action">
                            <!-- <a href="{{ route('siswa-pembayaran') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a> -->
                        </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                <tbody><tr>
                                    <th>Nama</th>
                                    <th>Biaya</th>
                                    <th>Kelas</th>
                                </tr>
                                @forelse($jenis_bayars as $jenis_bayar)
                                <tr>
                                    <th>{{ $jenis_bayar->nm_jenis }}</th>
                                    <th>Rp {{ number_format($jenis_bayar->biaya,0,',','.') }}</th>
                                    <th>{{ $jenis_bayar->kelas }}</th>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data</td>
                                </tr>
                                @endforelse
                                </tbody></table>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @elseif(auth()->user()->level == 'guru')
                <x-wali-kelas/>
                <x-guru/>
            @endif
        </div>
    </section>

@endsection