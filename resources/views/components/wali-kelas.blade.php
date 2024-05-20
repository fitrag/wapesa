@if(auth()->user()->is_walas)
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
        <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
        <div class="card-header">
            <h4>Total Siswa</h4>
        </div>
        <div class="card-body">
            {{ auth()->user()->wali_kelass()->latest()->first()?->kelas->siswas->count() }}
        </div>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
        <i class="fas fa-user-friends"></i>
        </div>
        <div class="card-wrap">
        <div class="card-header">
            <h4>Total Absen (Harian)</h4>
        </div>
        <div class="card-body">
            {{ \App\Models\Absensi::whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->count() }}
        </div>
        </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-success">
        <i class="fas fa-user-check"></i>
        </div>
        <div class="card-wrap">
        <div class="card-header">
            <h4>Siswa Hadir (Harian)</h4>
        </div>
        <div class="card-body">
            {{ \App\Models\Absensi::whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->whereHadir('h')->count() }}
        </div>
        </div>
    </div>
    </div>     
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
        <i class="fas fa-user-times"></i>
        </div>
        <div class="card-wrap">
        <div class="card-header">
            <h4>Siswa Tidak Hadir (Harian)</h4>
        </div>
        <div class="card-body">
            {{ \App\Models\Absensi::whereKelasId(auth()->user()->wali_kelass()->latest()->first()?->kelas_id)->where('hadir','!=','h')->count() }}
        </div>
        </div>
    </div>
    </div>             
</div>
@endif