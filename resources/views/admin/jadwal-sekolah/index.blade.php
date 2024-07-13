@extends('layouts.app', ['title' => 'Jadwal Sekolah'])

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


<script>

$('#kirimMapel').click(function(e){
    e.preventDefault();
    
    const mapel_id = $('#mapel_id').val();
    const hari = $('#hari').val();
    const kelas_id = "{{ request()->kelas_id }}"; // Mendapatkan nilai kelas_id dari PHP
    const tp_id = "{{ \App\Models\Tp::where('status', 1)->first()->id }}"; // Mendapatkan nilai tp_id dari PHP
    
    $.ajax({
        url: "{{ route('admin.jadwal-sekolah.store') }}",
        type: "POST",
        data: {
            '_token': "{{ csrf_token() }}",
            'mapel_id': mapel_id,
            'hari': hari,
            'kelas_id': kelas_id,
            'tp_id': tp_id
        },
        success: function(response){
            const data = JSON.parse(response)
            if(data.statusCode == 200){
                $('#buka').modal('hide')
                location.reload();
            }
        },
        error: function(xhr, status, error){
            console.error(xhr.responseText); // Menampilkan pesan error jika ada
        },
    });
});

    function ambilJadwal(){
        $.ajax({
            url:"{{ route('admin.jadwal-sekolah.ajax') }}",
            type:"GET",
            data:{
                kelas_id:'{{ request()->kelas_id }}'
            },
            success:function(e){
                $('#jadwal').append(e)
            }
        })
    }

    ambilJadwal()
</script>
@endpush

@section('content')

<section class="section">
    <div class="section-header">
    <h1>Jadwal Sekolah</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Jadwal</a></div>
        <div class="breadcrumb-item">Jadwal Sekolah</div>
    </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.jadwal-sekolah') }}" method="get">
                <div class="row align-items-center">
                    <div class="mb-3 col-lg-10">
                        <label for="" class="form-label">Pilih Kelas</label>
                        <select name="kelas_id" id="" class="form-control">
                            <option value="">Pilih kelas</option>
                            @foreach($kelass as $kelas)
                                <option value="{{ $kelas->id }}" {{ request()->kelas_id == $kelas->id ? 'selected' : '' }}>{{ $kelas->nm_kls }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <input type="submit" value="Lihat" class="btn btn-primary btn-md w-100">
                    </div>
                </div>
            </form>
        </div>

        @if(request()->kelas_id)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <button type="button" data-toggle="modal" data-target="#buka" class="btn btn-primary">Tambah Mata Pelajaran</button>
                    </div>
                </div>
                <div class="card-body" id="jadwal">
                    
                </div>
            </div>
        </div>
      </div>
      @endif
      
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="buka">  
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Mata Pelajaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('admin.kelas.store') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                <label for="name">Mata Pelajaran</label>
                <select name="mapel_id" id="mapel_id" class="form-control" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->nm_mapel }}</option>
                    @endforeach
                </select>
                @error('mapel_id')
                    <div class="alert alert-danger">Mohon di pilih mata pelajaran</div>
                @enderror
                <div class="invalid-feedback">
                    Mohon di pilih mata pelajaran
                </div>
                </div>
                
                <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option value="">-- Pilih Hari --</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
                @error('hari')
                    <div class="alert alert-danger">Mohon di isi hari</div>
                @enderror
                <div class="invalid-feedback">
                    Mohon di isi hari
                </div>
                </div>
                
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" id="kirimMapel" class="btn btn-primary btn-lg btn-block">
                        Tambah
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection