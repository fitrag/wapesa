@extends('layouts.app', ['title' => 'Dashboard '.auth()->user()->name])

@php

$jenis_bayars = App\Models\Jenisbayar::whereKelas(auth()->user()->siswa->kelas->alias)->whereTpId(App\Models\Tp::whereStatus(1)->first()->id)->get();

@endphp

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>List Pembayaran Sekolah</h1>
        </div>

        <div class="section-body">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header">
                  <h4>Pembayaran Sekolah</h4>
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
                            <th>Action</th>
                        </tr>
                        @if(!auth()->user()->siswa->pembayarans->isEmpty())
                            @foreach(auth()->user()->siswa->pembayarans as $pembayaran)
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
                                <td>
                                    <a href="{{ route('siswa-detail-pembayaran', ['id' => $pembayaran->id ]) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        @elseif(auth()->user()->siswa->pembayarans->isEmpty())

                            @foreach($jenis_bayars as $jenis_bayar)
                            <tr>
                                <td>{{ $jenis_bayar->nm_jenis }}</td>
                                <td>Rp {{ number_format($jenis_bayar->biaya,0, ',','.') }}</td>
                                <td>Rp 0</td>
                                <td>Rp {{ number_format($jenis_bayar->biaya,0, ',','.') }}</td>
                                <td>Rp 0</td>
                                <td><div class="badge badge-warning">Belum lunas</div></td>
                                <td>
                                    <!-- <a href="#" class="btn btn-primary">Detail</a> -->
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                    </div>
                    </div>
                </div>
                </div>        
            </div>
        </div>
    </section>

@endsection