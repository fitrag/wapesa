
@php

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus rupiah" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu rupiah" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu rupiah" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta rupiah" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar rupiah" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun rupiah" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pembayaran</title>

    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 10pt;
            padding:2px 0 !important
        }
        
    </style>
</head>

<body>

    <div class="d-flex justify-content-between align-items-center py-3">
        <div class="">
            <div class="">{{ \App\Models\Pengaturan::find(1)?->nama_sekolah }}</div>
            <div class="">{{ \App\Models\Pengaturan::find(1)?->alamat_sekolah }}</div>
        </div>
        <div class="">
            <div class="border border-dark py-2 px-3">
                BUKTI PEMBAYARAN
            </div>
        </div>
    </div>
    <div class="border-top py-2">
        <table class="table table-borderless">
            <tr>
                <td>Diterima dari</td>
                <td>:</td>
                <td>{{ $siswa->nm_siswa }}</td>
                <td>Tanggal bayar</td>
                <td>:</td>
                <td>{{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Nomor Induk</td>
                <td>:</td>
                <td>{{ $siswa->nis }}</td>
                <td>No. Bukti</td>
                <td>:</td>
                <td>

            @foreach($siswa->pembayarans as $pembayaran)
                @foreach($pembayaran->riwayatbayars as $riwayat)
                    {{ $riwayat->id }},
                @endforeach
            @endforeach

                </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->kelas->nm_kls }} | Status Siswa : {{ $siswa->user->is_active ? 'Aktif' : 'Tidak aktif' }}</td>
                <td>Metode</td>
                <td>:</td>
                <td>TUNAI</td>
            </tr>
            <tr>
                <td>Terbilang</td>
                <td>:</td>
                <td class="text-uppercase">
                    @foreach($siswa->pembayarans as $pembayaran)    
                        {{ terbilang($pembayaran->total_bayar)}}<br/>
                    @endforeach
                </td>
                <td>Petugas</td>
                <td>:</td>
                <td class="text-uppercase">{{ auth()->user()->name }}</td>
            </tr>
        </table>
    </div>
    <div class="border-top py-2">
        <strong>Dengan rincian pembayaran sebagai berikut :</strong>
    </div>
    <div class="border-top py-2">
        <table class="table table-borderless">
            @foreach($siswa->pembayarans as $pembayaran)
            <tr class="py-2">
                <td>{{ $loop->iteration }}</td>
                <td class="text-uppercase">{{ $pembayaran->jenisbayar->nm_jenis }}</td>
                <td class="text-right">Rp</td>
                <td class="text-right">{{ number_format($pembayaran->total_bayar, 0, ',','.') }}</td>
            </tr>
            @endforeach
            <tr class="border-top py-2">
                <td class="text-center">
                    <h6>Penyetor</h6>
                    <div style="height:45px"></div>
                    <p class="text-capitalize">(............................................................)</p>
                </td>
                <td class="text-center">
                    <h6>Penerima</h6>
                    <div style="height:45px"></div>
                    <p class="text-capitalize">({{ auth()->user()->name }})</p>
                </td>
                <td class="text-right">
                    <strong>Jumlah Rp</strong><br/>
                    <strong>Pembayaran Rp</strong><br/>
                    <strong>Kembalian Rp</strong><br/>
                    <hr>
                </td>
                <td class="text-right">
                    
                    {{ number_format($siswa->pembayarans->sum('total_bayar'), 0, ',','.') }}<br/>
                    {{ number_format($bayar, 0, ',','.') }}<br/>
                    {{ number_format($bayar-$siswa->pembayarans->sum('total_bayar'), 0, ',','.') }}<br/>
                    <hr>
                </td>
            </tr>
        </table>
    </div>
    

    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>