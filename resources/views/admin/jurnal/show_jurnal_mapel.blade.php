@extends('layouts.app', ['title' => 'Jurnal Guru / Mapel'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Jurnal Guru / Mapel</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Jurnal Mengajar</a></div>
            <div class="breadcrumb-item"> <a href="#">Jurnal Guru / Mapel</a></div>
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
                    <div class="p-1">
                        <a href="" class="btn btn-info btn-rounded btn-fw float-right mx-1" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                        <a href="#" data-target="#bukaModal" id="tombolModal" data-toggle="modal" class="btn btn-primary btn-rounded btn-fw float-right mx-1"><i class="fa fa-plus"></i> Tambah Jurnal</a>
                        <a href="{{ route('admin.jurnal-guru') }}" class="btn btn-dark btn-rounded btn-fw float-right mx-1"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive py-4">
                            <table class="table table-sm table-bordered" >
                                <tr>
                                    <th colspan="10" class="text-center">LEMBAR JURNAL GURU</th>
                                </tr>
                                <tr>
                                    <td colspan="3" width="20%">NAMA SEKOLAH</td>
                                    <td width="1%">:</td>
                                    <td colspan="2" width="40%">
                                        @foreach($pengaturan as $item)
                                            {{ $item->nama_sekolah}}
                                        @endforeach
                                    </td>
                                    
                                    <td colspan="2">TAHUN AJARAN</td>
                                    <td>:</td>
                                    <td colspan="2">
                                    @foreach($datax as $item)
                                        {{ $item->nm_tp}}
                                    @endforeach    
                                </tr>
                                <tr>
                                    <td colspan="3" width="10%">MATA PELAJARAN</td>
                                    <td>:</td>
                                        
                                    <td colspan="2">
                                        @foreach($datax as $item)
                                            {{$item->nm_mapel}}
                                            @endforeach 
                                        </td>

                                    <td colspan="2">SEMESTER</td>
                                    <td>:</td>
                                    @foreach($datax as $item)
                                    <td colspan="2">
                                        {{$item->semester}}
                                    </td>
                                    @endforeach 
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive py-4">
                            <table class="table table-striped table-md table-hover" id="table-1">
                                <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Hari/Tanggal</th>
                                    <th>Jam Ke</th>
                                    <th>Kelas</th>
                                    <th>KD/Materi Pokok/Sub Materi</th>
                                    <th>TM Ke</th>
                                    <th>Selesai/tidak alasan</th>
                                    <th>Absensi</th>
                                    <th>Ket</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                            {{date('l, d/m/Y', strtotime($item->tgl))}}</td>
                                            <td>{{$item->jamke}}</td>
                                            <td>{{$item->nm_kls}}</td>
                                            <td>{{$item->materi}}</td>
                                            <td>{{$item->tmke}}</td>
                                            <td>{{$item->status}}</td>
                                            <td>{{$item->absensi}}</td>
                                            <td>{{$item->ket}}</td>
                                            <td>
                                            <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                                    <a class="dropdown-item" data-toggle="modal" onclick="editModal" data-target="#modalEdit" href="#"> Edit </a>
                                                    <form action="" class="pull-left"  method="post">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade bd-example-modal-md" id="bukaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-md" role="document" >
    <div class="modal-content" style="background: #fff;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jurnal Guru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="tambahJurnal">
        </div>
    </div>
  </div>
</div>
@endsection



@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#tombolModal').click(function(){
        $.ajax({
            url:"{{route('ajax.tambah_jurnal')}}",
            type:"POST",
            data: {
                'mapel_id' : '{{ $data[0]->mapel_id }}',
                'tp_id' : '{{ $data[0]->tp_id }}',
                '_token'     : '{{ csrf_token() }}',
                'kelas_id' : '{{ $data[0]->kelas_id }}',
                'semester' :'{{ $datax[0]->semester }}'
            },
            success:function(data){
                $('#tambahJurnal').html(data)
            }
        })
    })
} );

function editModal(id){
  $.ajax({
    url:"/edit_jurnal/" + id,
    success:function(data){
      $('#editJurnal').html(data)
    }
  })
}
</script>
@endpush