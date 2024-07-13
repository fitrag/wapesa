@extends('layouts.app', ['title' => 'Tambah Pembayaran'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script>
    function nominal(){
        console.log(this)
    }

    $('#formBayar').on('keyup', function(){
        let totalBayar = $.map($('input[id^="bayar"]'), function(el, id){
            return parseInt(el.value, 10) || 0
        }).reduce(function(a, b){
            return a + b
        }, 0)

        let totalPotongan = $.map($('input[id^="potongan"]'), function(el, id){
            return parseInt(el.value, 10) || 0
        }).reduce(function(a, b){
            return a + b
        }, 0)

        $('#total').text('Rp '+ new Intl.NumberFormat("id-ID", {
            currency:"IDR"
        }).format(totalBayar))

        let uangBayar = $('#uangBayar').val();
        let kembalian = uangBayar - totalBayar

        if(kembalian > 0){
            $('#uangKembalian').text('Rp '+ new Intl.NumberFormat("id-ID", {
                currency:"IDR"
            }).format(kembalian))
        }else{
            $('#uangKembalian').text('Rp 0')
        }
        // $.ajax({
        //     url:"{{ route('ajax-total') }}",
        //     type:"POST",
        //     data:{
        //         '_token':"{{ csrf_token() }}",
        //         'data':$('#formBayar input').val()
        //     },
        //     success:function(data){
        //         console.log(data)
        //     }
        // })
    })
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Tambah Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Pembayaran</a></div>
        <div class="breadcrumb-item">Tambah Pembayaran</div>
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
        
        <div id="tambahPembayaran">
          <div class="card">
              <div class="card-body">
                <div class="py-3 text-right">
                    <a href="#" onclick="return window.history.back()" class="btn btn-dark">Kembali</a>
                </div>
                 <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <td>NIS</td>
                            <td>{{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $siswa->nm_siswa }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>{{ $siswa->kelas->nm_kls }}</td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{ ($siswa->pembayarans->isEmpty()) ? route('pembayaran-store'): route('pembayaran-edit') }}" method="post" id="formBayar">
                @csrf
                <input type="hidden" name="siswaId" value="{{ $siswa->id }}">
                 <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Biaya</th>
                            <th>Potongan</th>
                            <th>Total</th>
                            <th>Kurang</th>
                            <th>Bayar</th>
                            <th>Potongan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$siswa->pembayarans->isEmpty())
                            @foreach($siswa->pembayarans as $pembayaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembayaran->jenisbayar->nm_jenis }}</td>
                                <td>Rp {{ number_format($pembayaran->jenisbayar->biaya,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->potongan,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->total_bayar,0, ',','.') }}</td>
                                <td>Rp {{ number_format($pembayaran->sisa_bayar,0, ',','.') }}</td>
                                <td class="text-center" colspan="{{ $pembayaran->status == 'lunas' ? 2 : 0 }}">
                                    @if($pembayaran->status != 'lunas')
                                        <input type="number" name="bayar[]" value="0" id="bayar" class="form-control">
                                        <input type="hidden" name="idpembayaran[]" value="{{ $pembayaran->id }}">
                                        <input type="hidden" name="idjenisbayar[]" value="{{ $pembayaran->jenisbayar_id }}">
                                    @else
                                        <span class="badge badge-success">Lunas</span>
                                    @endif
                                </td>
                                @if($pembayaran->status != 'lunas')
                                <td>
                                    <input type="number" name="potongan[]" id="potongan" value="0" class="form-control">
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        @elseif($siswa->pembayarans->isEmpty())
                            @foreach($jenis_bayars as $jenis_bayar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jenis_bayar->nm_jenis }}</td>
                                <td>Rp {{ number_format($jenis_bayar->biaya,0, ',','.') }}</td>
                                <td>Rp {{ number_format(0,0, ',','.') }}</td>
                                <td>Rp {{ number_format(0,0, ',','.') }}</td>
                                <td>Rp {{ number_format($jenis_bayar->biaya,0, ',','.') }}</td>
                                <td>
                                    <input type="number" name="bayar[]" value="0" id="bayar" class="form-control">
                                    <input type="hidden" name="idjenisbayar[]" value="{{ $jenis_bayar->id }}">
                                    <input type="hidden" name="idpembayaran[]" value="">
                                </td>
                                <td>
                                    <input type="number" name="potongan[]" id="potongan" value="0" class="form-control">
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                 </table>
                 <table class="table table-bordered mb-3">
                    <thead>
                        <tr>
                            <th class="text-center">Total Bayar</th>
                            <th class="text-center">Bayar</th>
                            <th class="text-center">Kembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center text-success"><strong><h4 id="total">Rp 0</h4></strong></td>

                            <td class="text-center">
                                <input type="number" name="uangBayar" value="0" id="uangBayar" class="form-control">
                            </td>
                            <td class="text-center text-danger">
                                <strong><h4 id="uangKembalian">Rp 0</h4></strong>
                            </td>
                        </tr>
                    </tbody>
                 </table>
                 <div class="text-right">
                    <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                 </div>
                </form>
              </div>
          </div>

          <div id="hasil"></div>
          </div>
        </div>

    </div>
    </div>
</section>

@if(session()->has('cetak')) 

<script>
    window.open('{{session()->get('cetak')}}', "_blank");
</script>

@endif

@endsection