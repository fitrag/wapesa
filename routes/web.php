<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, AuthController, UserController, AbsensiController, GuruAjarController, SiswaController, JenisBayarController, KelasController, TpController, GuruController, JurnalGuruController, LihatAbsensiController, SinkronisasiController, PengaturanController, WaliKelasController, PembayaranController, AjaxController, MapelController, PrakerinController, JadwalSekolahController};
use App\Http\Controllers\Siswa\SiswaController as Siswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', AuthController::class.'@login')->name('index');
Route::get('/login', AuthController::class.'@login')->name('login');
Route::post('/login', AuthController::class.'@auth')->name('auth');
Route::get('/register', AuthController::class.'@register')->name('register');
Route::post('/register', AuthController::class.'@store')->name('register-store');
Route::get('/logout', AuthController::class.'@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', IndexController::class.'@dashboard')->name('dashboard');
    
    // Pengaturan
    Route::get('/admin/pengaturan', PengaturanController::class.'@index')->name('pengaturan');
    Route::put('/admin/pengaturan/{id}/update', PengaturanController::class.'@update')->name('pengaturan-update');
    Route::put('/admin/pengaturan/{id}/sinkronisasi', PengaturanController::class.'@sinkronisasi')->name('pengaturan-sinkronisasi');
    
    // Ajax Sinkronisasi data
    Route::get('/admin/sinkron-absensi', IndexController::class.'@sinkronAbsensi')->name('sinkron-absensi');
    Route::post('/admin/sinkron-absensi/proses', SinkronisasiController::class.'@sinkronAbsensi')->name('sinkron-absensi-proses');
    
    // Data User
    Route::get('/admin/user', UserController::class.'@index')->name('admin.user');
    Route::post('/admin/user', UserController::class.'@store')->name('admin.user.store');
    Route::get('/admin/user/{user:id}/edit', UserController::class.'@edit')->name('admin.user.edit');
    Route::put('/admin/user/{user:id}/update', UserController::class.'@update')->name('admin.user.update');
    Route::delete('/admin/user/{user:id}/delete', UserController::class.'@destroy')->name('admin.user.delete');
    Route::get('/admin/user/{user:id}/delete', UserController::class.'@destroy')->name('admin.user.delete-ajax');
    
    // Wali Kelas
    Route::get('/admin/wali-kelas', WaliKelasController::class.'@index')->name('admin.wali-kelas');
    Route::post('/admin/wali-kelas', WaliKelasController::class.'@store')->name('admin.wali-kelas.store');
    Route::delete('/admin/wali-kelas/{wali_kelas:id}/delete', WaliKelasController::class.'@destroy')->name('admin.wali-kelas.delete');
    
    // Lihat Absensi
    Route::get('/admin/lihat-absensi', LihatAbsensiController::class.'@absensitgl')->name('lihat-tgl-absensi');
    Route::get('/admin/cetak-absensi-tgl', LihatAbsensiController::class.'@cetak_absensi_tgl')->name('cetak-tgl-absensi');
    Route::get('/admin/cetak-absensi-bln', LihatAbsensiController::class.'@cetak_absensi_bln')->name('cetak-bln-absensi');
    Route::post('/admin/proses_cetakabsensi_tgl', LihatAbsensiController::class.'@proses_cetakabsensi_tgl')->name('proses_cetakabsensi_tgl');
    Route::post('/admin/proses_cetakabsensi_bln', LihatAbsensiController::class.'@proses_cetakabsensi_bln')->name('proses_cetakabsensi_bln');

    // Ajax Scan QRCode
    Route::post('/admin/absensi/scanning', AbsensiController::class.'@scanning')->name('scanning-absensi');
    
    // Data Siswa
    Route::resource('admin/siswa', SiswaController::class)
    ->name('index', 'admin.siswa')
    ->name('store', 'admin.siswa.store')
    ->name('edit', 'admin.siswa.edit_siswa')
    ->name('update', 'admin.siswa.update')
    ->name('destroy', 'admin.siswa.delete')
    ->name('show', 'admin.siswa.show');
    Route::post('admin/siswa/import', SiswaController::class.'@import')->name('admin.siswa.import');
    Route::get('admin/siswa/naik_kelas', SiswaController::class.'@kelas')->name('admin.siswa.naik-kelas');
    Route::get('admin/{siswa:id}/delete', SiswaController::class.'@destroy')->name('admin.siswa.delete-ajax');
    Route::get('admin/{siswa:id}/qrcode', SiswaController::class.'@qrcode')->name('admin.siswa.qrcode');
    Route::post('admin/siswa/update_kelas', SiswaController::class.'@update_kelas')->name('admin.update.kelas');
    
    
    
    // Ajax Data Siswa
    Route::get('/admin/siswa-ajax', IndexController::class.'@siswaAjax')->name('siswa-ajax');
    Route::get('/admin/user-ajax', IndexController::class.'@userAjax')->name('user-ajax');
    Route::get('/admin/prakerin-ajax', IndexController::class.'@prakerinAjax')->name('prakerin-ajax');
    Route::get('/admin/siswa-prakerin-ajax', IndexController::class.'@siswaPrakerinAjax')->name('siswa-prakerin-ajax');
    
    
    // Data Kelas
    Route::resource('admin/kelas', KelasController::class)
    ->name('index', 'admin.kelas')
    ->name('store', 'admin.kelas.store')
    ->name('edit', 'admin.kelas.edit')
    ->name('update', 'admin.kelas.update')
    ->name('destroy', 'admin.kelas.delete');
    
    // Data Jenis Bayar
    Route::resource('admin/jenis-bayar', JenisBayarController::class)
    ->name('index', 'admin.jenis-bayar')
    ->name('store', 'admin.jenis-bayar.store')
    ->name('edit', 'admin.jenis-bayar.edit')
    ->name('update', 'admin.jenis-bayar.update')
    ->name('destroy', 'admin.jenis-bayar.delete');
    
    // Data Tahun Pelajaran
    Route::resource('admin/tahun-pelajaran', TpController::class)
    ->name('index', 'admin.tahun-pelajaran')
    ->name('store', 'admin.tahun-pelajaran.store')
    ->name('edit', 'admin.tahun-pelajaran.edit')
    ->name('update', 'admin.tahun-pelajaran.update')
    ->name('destroy', 'admin.tahun-pelajaran.delete');
    
    // Data Guru
    Route::resource('admin/guru', GuruController::class)
    ->name('index', 'admin.guru')
    ->name('store', 'admin.guru.store')
    ->name('edit', 'admin.guru.edit')
    ->name('update', 'admin.guru.update')
    ->name('destroy', 'admin.guru.delete');
    Route::post('admin/guru/import', GuruController::class.'@import')->name('admin.guru.import');
    
    //Guru Ajar
    Route::resource('admin/guru-ajar', GuruAjarController::class)
    ->name('index', 'admin.guru-ajar')
    ->name('store', 'admin.guru-ajar.store')
    ->name('edit', 'admin.guru-ajar.edit')
    ->name('update', 'admin.guru-ajar.update')
    ->name('destroy', 'admin.guru-ajar.delete')
    ->name('show', 'admin.guru-ajar.show');
    
    //Mapel
    Route::resource('admin/mapel', MapelController::class);
    
    //Jurnal Guru 
    Route::resource('admin/jurnal-guru', JurnalGuruController::class)
    ->name('index', 'admin.jurnal-guru')
    ->name('store', 'admin.jurnal-guru.store')
    ->name('edit', 'admin.jurnal-guru.edit')
    ->name('update', 'admin.jurnal-guru.update')
    ->name('destroy', 'admin.jurnal-guru.delete')
    ->name('show', 'admin.jurnal-guru.show');
    Route::get('/admin/jurnal/tampil_jurnalkelas/{guru_ajar}', JurnalGuruController::class.'@jurnal_kelas')->name('admin.jurnal.tampil_jurnalkelas');
    Route::get('jurnal_test', function(){
        return redirect()->back();
    })->name('jurnal_test');
    Route::get('/admin/jurnal/tampil_jurnal_mapel', JurnalGuruController::class.'@jurnal_mapel')->name('admin.tampil-jurnal-mapel');
    Route::get('cetak.jurnalpdf/{mapel_id}/{guru_id}/{kelas_id}/{tp_id}', JurnalGuruController::class.'@cetakpdf')->name('cetak.jurnalpdf');
    Route::get('admin/jurnal/tampil_jurnal_admin/{guru_id}/{tp_id}', JurnalGuruController::class.'@jurnal_admin_perguru')->name('tampil.jurnal.admin.guru');
    
    
    // AJAX jurnal guru
    Route::post('admin/tambah_jurnal', AjaxController::class.'@tambahJurnal')->name('ajax.tambah_jurnal');
    Route::get('edit_jurnal/{id}', AjaxController::class.'@editJurnal')->name('ajax.edit_jurnal');
    
    //absensi
    Route::get('/admin/absensi/scan', AbsensiController::class.'@scan')->name('scan-absensi');
    // Route::get('/admin/absensi/kelas', AbsensiController::class.'@kelas')->name('admin.siswa.naik-kelas');
    Route::get('/admin/absensi/harian', AbsensiController::class.'@harian')->name('absensi-harian');
    Route::get('/admin/absensi/tambah', AbsensiController::class.'@tambah')->name('absensi-tambah');
    Route::post('/admin/absensi/tambah', AbsensiController::class.'@store')->name('absensi-store');
    Route::get('/admin/absensi/bulanan', AbsensiController::class.'@bulanan')->name('absensi-bulanan');
    Route::get('/admin/absensi/tahun-pelajaran', AbsensiController::class.'@tahunPelajaran')->name('absensi-tahun-pelajaran');
    
    Route::get('/admin/pembayaran/tambah', PembayaranController::class.'@tambah')->name('pembayaran-tambah');
    Route::get('/admin/pembayaran/tambah/{siswa:id}', PembayaranController::class.'@form')->name('pembayaran-form');
    Route::post('/admin/pembayaran/store', PembayaranController::class.'@store')->name('pembayaran-store');
    Route::post('/admin/pembayaran/edit', PembayaranController::class.'@edit')->name('pembayaran-edit');
    Route::get('/admin/pembayaran/cetak/{id}/{bayar}', PembayaranController::class.'@cetak')->name('pembayaran-cetak');
    
    // Ajax Routing
    Route::post('/ajax/get/siswa/all', AjaxController::class.'@siswaAll')->name('ajax-siswa-all');
    Route::post('/ajax/total', AjaxController::class.'@total')->name('ajax-total');
    
    // Route Siswa Dashboard
    Route::get('/siswa/dashboard', Siswa::class.'@index')->name('siswa-dashboard');

    Route::get('/siswa/absensi', Siswa::class.'@absensi')->name('siswa-absensi');
    Route::get('/siswa/absensi/scan', Siswa::class.'@scan')->name('siswa-scan-absensi');
    Route::post('/siswa/absensi/scanning', Siswa::class.'@scanning')->name('siswa-scanning-absensi');
    
    Route::get('/siswa/pembayaran', Siswa::class.'@pembayaran')->name('siswa-pembayaran');
    Route::get('/siswa/pembayaran', Siswa::class.'@pembayaran')->name('siswa-pembayaran');
    Route::get('/siswa/pembayaran/{id}/detail', Siswa::class.'@detailPembayaran')->name('siswa-detail-pembayaran');
    
    // Prakerin
    Route::get('/admin/prakerin', PrakerinController::class.'@index')->name('admin.prakerin');
    Route::post('/admin/prakerin', PrakerinController::class.'@store')->name('admin.prakerin.store');
    Route::get('/admin/prakerin/{prakerin:id}/edit', PrakerinController::class.'@edit')->name('admin.prakerin.edit');
    Route::put('/admin/prakerin/{prakerin:id}/update', PrakerinController::class.'@update')->name('admin.prakerin.update');
    Route::get('/admin/prakerin/{prakerin:id}/delete', PrakerinController::class.'@destroy')->name('admin.prakerin.delete-ajax');
    Route::get('/admin/prakerin/{prakerin:id}/tambah-siswa', PrakerinController::class.'@tambahSiswa')->name('admin.prakerin.tambah-siswa');
    
    Route::get('/admin/prakerin/siswa-prakerin', PrakerinController::class.'@siswaPrakerin')->name('admin.prakerin.siswa-prakerin');
    
    // Prakerin Ajax
    Route::post('/admin/prakerin/tambah-siswa', PrakerinController::class.'@tambahSiswaAjax')->name('admin.prakerin.tambahSiswaAjax');
    Route::post('/admin/prakerin/siswa-prakerin/delete', PrakerinController::class.'@siswaPrakerinHapusAjax')->name('admin.prakerin.siswa-prakerin-hapus-ajax');

    // Jadwal Sekolah
    Route::get('/admin/jadwal-sekolah', JadwalSekolahController::class.'@index')->name('admin.jadwal-sekolah');
    Route::get('/admin/jadwal-sekolah/ajax', JadwalSekolahController::class.'@indexAjax')->name('admin.jadwal-sekolah.ajax');
    Route::post('/admin/jadwal-sekolah/store', JadwalSekolahController::class.'@store')->name('admin.jadwal-sekolah.store');
    Route::post('/admin/jadwal-sekolah/update', JadwalSekolahController::class.'@update')->name('admin.jadwal-sekolah.update');
    Route::get('/admin/jadwal-sekolah/{id}/delete', JadwalSekolahController::class.'@destroy')->name('admin.jadwal-sekolah.delete');
    
});

Route::get('/qrcode', IndexController::class.'@qrcode');
