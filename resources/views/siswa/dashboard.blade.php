@extends('layouts.app', ['title' => 'Dashboard '.auth()->user()->name])

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="ml-auto">
                NIS : {{ auth()->user()->siswa->nis }}
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-hero">
                        <div class="card-header" style="background:linear-gradient(to top, #ff8d00, #fff700) !important">
                        <div class="card-icon" style="color:#f1f38c !important">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="card-description">Presentase Kehadiran</div>
                        @php

                            $hBulan = App\Models\Absensi::where([
                            'kelas_id' => auth()->user()->siswa->kelas_id,
                            'nis'    => auth()->user()->siswa->nis
                            ])
                            ->where('hadir','h')
                            ->whereMonth('created_at', date('m'))->count();
                        
                            $tgls = App\Models\Absensi::where([
                                'kelas_id' => auth()->user()->siswa->kelas_id,
                                'nis'    => auth()->user()->siswa->nis
                                ])
                                ->whereMonth('created_at', date('m'))->count();

                            $presentase = $hBulan == 0 ? 0 : ($hBulan/$tgls) * 100;

                            $jenis_bayars = App\Models\Jenisbayar::whereKelas(auth()->user()->siswa->kelas->alias)->whereTpId(App\Models\Tp::whereStatus(1)->first()->id)->get();

                        @endphp
                        <h4>{{ round($presentase) }}%</h4>
                        <div class="card-description">Bulan ini</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                        <h4>Jadwal Pelajaran Hari {{ \Carbon\Carbon::parse(date('Y-m-d'))->isoFormat('dddd') }}</h4>
                        <div class="card-header-action">
                            <!-- <a href="{{ route('siswa-pembayaran') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a> -->
                        </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-invoice">
                                <table class="table table-striped">
                                <tbody><tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                </tr>
                                @forelse($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jadwal->mapel->nm_mapel }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="2">Belum ada data</td>
                                    </tr>
                                @endforelse
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                        <h4>Pembayaran Sekolah</h4>
                        <div class="card-header-action">
                            <a href="{{ route('siswa-pembayaran') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                        </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                <tbody><tr>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Sudah bayar</th>
                                    <th>Status</th>
                                </tr>
                                @if(!auth()->user()->siswa->pembayarans->isEmpty())
                                    @foreach(auth()->user()->siswa->pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ $pembayaran->jenisbayar->nm_jenis }}</td>
                                        <td>Rp {{ number_format($pembayaran->jenisbayar->biaya,0, ',','.') }}</td>
                                        <td>Rp {{ number_format($pembayaran->total_bayar,0, ',','.') }}</td>
                                        @if($pembayaran->status == 'lunas')
                                            <td><div class="badge badge-success">Lunas</div></td>
                                        @else
                                            <td><div class="badge badge-warning">Belum lunas</div></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @elseif(auth()->user()->siswa->pembayarans->isEmpty())

                                    @foreach($jenis_bayars as $jenis_bayar)
                                    <tr>
                                        <td>{{ $jenis_bayar->nm_jenis }}</td>
                                        <td>Rp {{ number_format($jenis_bayar->biaya,0, ',','.') }}</td>
                                        <td>Rp 0</td>
                                        <td><div class="badge badge-warning">Belum lunas</div></td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-5">
                    <div class="card card-hero">
                        <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="card-description">Kelas</div>
                        <h4>{{ auth()->user()->siswa->kelas->nm_kls }}</h4>
                        <div class="card-description">Wali kelas : {{ App\Models\Kelas::whereId(auth()->user()->siswa->kelas_id)->first()->wali_kelass()->latest()->first()?->user->name }}</div>
                        </div>
                        <div class="card-body p-0">
                        <div class="pt-3 px-3 font-weight-bold">PRESENSI</div>
                        <div class="tickets-list">
                            @foreach($absensis as $absen)
                            <a href="{{ route('siswa-absensi') }}" class="ticket-item">
                            <div class="ticket-title">
                                <h4>{{ $absen->siswa->nm_siswa }}</h4>
                            </div>
                            <div class="ticket-info d-flex align-items-center">
                                <div>
                                    @if($absen->hadir == 'h')
                                    <span class="badge badge-success">Hadir</span>
                                    @elseif($absen->hadir == 'i')
                                    <span class="badge badge-info">Izin</span>
                                    @elseif($absen->hadir == 's')
                                    <span class="badge badge-warning">Sakit</span>
                                    @elseif($absen->hadir == 'a')
                                    <span class="badge badge-danger">Alpha</span>
                                    @elseif($absen->hadir == 'al')
                                    <span class="badge badge-danger">Alpha Lari</span>
                                    @endif
                                </div>
                                <div class="bullet"></div>
                                <div class="">{{ Carbon\Carbon::parse($absen->created_at)->isoFormat('dddd, D/MM/YYYY') }} - {{ $absen->created_at->diffForHumans() }}</div>
                            </div>
                            </a>
                            @endforeach
                            <a href="{{ route('siswa-absensi') }}" class="ticket-item ticket-more">
                            Lihat semua <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </section>

@endsection