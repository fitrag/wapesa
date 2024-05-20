<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">{{ \App\Models\Pengaturan::find(1)?->nama_sekolah }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>
        @if(auth()->user()->level == 'admin')
        <li class="menu-header">Data Master</li>
        <li class="{{ request()->is('admin/user*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user') }}"><i class="fas fa-users"></i> <span>Data User</span></a></li>
        <li class="{{ request()->is('admin/tahun-pelajaran*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.tahun-pelajaran') }}"><i class="fas fa-chalkboard"></i> <span>Data Tahun Pelajaran</span></a></li>
        <li class="{{ request()->is('admin/jenis-bayar*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.jenis-bayar') }}"><i class="fas fa-money-check"></i> <span>Data Jenis Bayar</span></a></li>
        <li class="{{ request()->is('admin/kelas*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.kelas') }}"><i class="fas fa-building"></i> <span>Data Kelas</span></a></li>
        <li class="{{ request()->is('admin/siswa*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.siswa') }}"><i class="fas fa-user-graduate"></i> <span>Data Siswa</span></a></li>
        <li class="{{ request()->is('admin/guru*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.guru') }}"><i class="fas fa-user-tie"></i> <span>Data Guru</span></a></li>
        
        <li class="menu-header">Absensi</li>
        <li class="{{ request()->is('admin/absensi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('scan-absensi') }}"><i class="fas fa-qrcode"></i> <span>Scan Kartu</span></a></li>
        <li><a class="nav-link"><i class="fas fa-fingerprint"></i> <span>Tambah Absensi</span></a></li>
        <li class="dropdown {{ request()->is('admin/lihatabseni*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Lihat Absensi</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->is('admin/lihatabseni*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('lihat-tgl-absensi') }}">Absensi Per-Tanggal</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Absensi Per-Bulan</a></li>
            </ul>
        </li>
        <li><a class="nav-link"><i class="fas fa-print"></i> <span>Cetak Absensi</span></a></li>


        <li class="menu-header">Lainnya</li>
        <li class="{{ request()->is('admin/pengaturan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengaturan') }}"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown bg-warning text-white" data-toggle="dropdown"><i class="fas fa-flask"></i> <span>Experiment</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('sinkron-absensi') }}">Sinkron Absensi</a></li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->level != 'admin' AND auth()->user()->is_walas)
        <li class="menu-header">Absensi</li>
        <li class="{{ request()->is('admin/absensi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('scan-absensi') }}"><i class="fas fa-qrcode"></i> <span>Scan Kartu</span></a></li>
        <li><a class="nav-link"><i class="fas fa-fingerprint"></i> <span>Tambah Absensi</span></a></li>
        <li><a class="nav-link"><i class="fas fa-calendar"></i> <span>Lihat Absensi</span></a></li>
        <li><a class="nav-link"><i class="fas fa-print"></i> <span>Cetak Absensi</span></a></li>
        @endif
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
    <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-desktop"></i> v1.0.0
    </a>
    </div>
</aside>