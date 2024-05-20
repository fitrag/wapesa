@extends('layouts.app', ['title' => 'Data Siswa'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
//   $("#table-1").dataTable({
//     serverSide:true,
//     processing:true,
//     ajax:{
//       url:"{{ route('siswa-ajax') }}"
//     },
//     columns:[
//       {
//         data:'nis',
//         name:'nis'
//       },
//       {
//         data:'nisn',
//         name:'nisn'
//       },
//       {
//         data:'nm_siswa',
//         name:'nama'
//       },
//       {
//         data:'kelas',
//         name:'kelas'
//       },
//       {
//         data:'username',
//         name:'username'
//       },
//       {
//         data:'action',
//         name:'action'
//       },
//     ]
//   });
</script>
@endpush

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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">NO</th>
                            <th rowspan="2">Nama</th>
                            <th colspan="4" class="text-center">Keterangan</th>
                        </tr>
                        <tr>
                            <th class="text-center">H</th>
                            <th class="text-center">I</th>
                            <th class="text-center">S</th>
                            <th class="text-center">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $siswa)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nm_siswa }}</td>
                            @if($siswa->absensis)
                                @foreach($siswa->absensis as $keterangan)
                                    <td align="center">{{ $keterangan->hadir == 'h' ? '✅' : '' }}</td>
                                    <td align="center">{{ $keterangan->hadir == 'i' ? '✅' : '' }}</td>
                                    <td align="center">{{ $keterangan->hadir == 's' ? '✅' : '' }}</td>
                                    <td align="center">{{ $keterangan->hadir == 'a' ? '✅' : '' }}</td>
                                @endforeach
                            @endif
                            @if($siswa->absensis->isEmpty())
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td align="center" colspan="2" rowspan="2" class="font-weight-bold">TOTAL</td>
                            <td align="center">{{ $absensis->where('hadir','h')->count() }}</td>
                            <td align="center">{{ $absensis->where('hadir','i')->count() }}</td>
                            <td align="center">{{ $absensis->where('hadir','s')->count() }}</td>
                            <td align="center">{{ $absensis->where('hadir','a')->count() }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center" style="font-weight:bold;font-size:18px">{{ $absensis->where('hadir','h')->count() + $absensis->where('hadir','i')->count() + $absensis->where('hadir','s')->count() + $absensis->where('hadir','a')->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection