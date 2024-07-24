@extends('layouts.app', ['title' => 'Dashboard '.auth()->user()->name])

@php

$jenis_bayars = App\Models\Jenisbayar::whereKelas(auth()->user()->siswa->kelas->alias)->whereTpId(App\Models\Tp::whereStatus(1)->first()->id)->get();

@endphp

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Detail Pembayaran : {{ $pembayaran->jenisbayar->nm_jenis }}</h1>
            <div class="ml-auto">
                <a href="{{ route('siswa-pembayaran') }}" class="btn btn-dark">Kembali</a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header">
                  <h4>{{ $pembayaran->siswa->nm_siswa }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                        <tbody><tr>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Sudah bayar</th>
                            <th>Kurang</th>
                            <th>Potongan</th>
                            <th>Status</th>
                        </tr>
                            <tr>
                                <td>{{ $pembayaran->jenisbayar->nm_jenis }}</td>
                                <td>Rp {{ number_format($pembayaran->jenisbayar->biaya,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->total_bayar,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->sisa_bayar,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->potongan,0, ',','.') }}</td>
                                @if($pembayaran->status == 'lunas')
                                    <td><div class="badge badge-success">Lunas</div></td>
                                @else
                                    <td><div class="badge badge-warning">Belum lunas</div></td>
                                @endif
                            </tr>
                        </tbody></table>
                    </div>
                </div>
                <div class="card-header">
                  <h4>Riwayat Pembayaran</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-invoice">
                        <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Bayar</th>
                        </tr>
                            @forelse($pembayaran->riwayatbayars as $riwayat)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($riwayat->created_at)->isoFormat('dddd, D/MM/YYYY') }}</td>
                                <td>Rp {{ number_format($riwayat->jumlah_bayar,0, ',','.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Belum ada pembayaran yang dilakukan</td>
                            </tr>
                            @endforelse
                        </tbody></table>
                    </div>
                </div>
                </div>
                </div>        
            </div>
        </div>
    </section>

@endsection