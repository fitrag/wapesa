@extends('layouts.app', ['title' => 'Data Tempat Praktek Kerja Industri'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script>

    function tambahSiswa(id){
        $.ajax({
            url:"{{ route('admin.prakerin.tambahSiswaAjax') }}",
            type:'POST',
            data:{
                '_token':'{{ csrf_token() }}',
                'siswa_id':id,
                'prakerin_id':'{{ $prakerin->id }}',
                'tp_id':'{{ \App\Models\Tp::whereStatus(1)->first()?->id }}'
            },
            success:function(e){
                let data = JSON.parse(e)
                if(data.statusCode == 200){
                    ambilSiswaSudah()
                    ambilSiswaBelum()
                }else if(data.statusCode == 500){
                    alert(data.message)
                }
            }
        })
    }

    function hapusSiswaSudah(id){
        $.ajax({
            url:"{{ route('admin.prakerin.siswa-prakerin-hapus-ajax') }}",
            type:'POST',
            data:{
                '_token':'{{ csrf_token() }}',
                'id':id,
            },
            success:function(e){
                let data = JSON.parse(e)
                if(data.statusCode == 200){
                    ambilSiswaSudah()
                    ambilSiswaBelum()
                }else if(data.statusCode == 500){
                    alert(data.message)
                }
            }
        })
    }
    
    function ambilSiswaSudah(){
        $.ajax({
            url:"{{ route('admin.prakerin.siswa-prakerin') }}",
            type:'GET',
            data:{
                'id':'{{ $prakerin->id }}'
            },
            success:function(e){
                $('#dataSiswa').html(e)
            }
        })
    }

    ambilSiswaSudah();
    ambilSiswaBelum();

    function ambilSiswaBelum(){

        $("#table-1").dataTable({
            serverSide:true,
            processing:true,
            destroy:true,
            ajax:{
                url:"{{ route('siswa-prakerin-ajax') }}"
            },
            columns:[
                {
                    data:'nis',
                    name:'nis'
                },
                {
                    data:'nm_siswa',
                    name:'nama'
                },
                {
                    data:'kelas',
                    name:'kelas'
                },
                {
                    data:'action',
                    name:'action'
                },
            ]
        });
    }
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Tambah Siswa Praktek</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Prakerin</a></div>
        <div class="breadcrumb-item">Data Tempat Praktek Kerja Industri</div>
    </div>
    </div>

    <div class="section-body">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Nama Industri</td>
                                    <td>{{ $prakerin->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>{{ $prakerin->telpon }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $prakerin->alamat != '' ? $prakerin->alamat : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinat</td>
                                    <td>{{ $prakerin->latitude }}, {{ $prakerin->longitude }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                <h4>Siswa yang akan Praktek disini</h4>
                <div class="card-header-action">
                    <!--<a href="{{ route('siswa-pembayaran') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>-->
                </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-hovered">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>        
                        </tbody>
                        <tbody id="dataSiswa">
                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Tambahkan siswa lainnya</h6>
            </div>
            <div class="">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                <thead>                                 
                    <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody> 
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