<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, AuthController, UserController, AbsensiController, SiswaController, JenisBayarController, KelasController, TpController, GuruController, LihatAbsensiController, SinkronisasiController, PengaturanController, WaliKelasController, PembayaranController};

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
    ->name('destroy', 'admin.siswa.delete');
    Route::post('admin/siswa/import', SiswaController::class.'@import')->name('admin.siswa.import');
    Route::get('admin/{siswa:id}/delete', SiswaController::class.'@destroy')->name('admin.siswa.delete-ajax');
    Route::get('admin/{siswa:id}/qrcode', SiswaController::class.'@qrcode')->name('admin.siswa.qrcode');

    // Ajax Data Siswa
    Route::get('/admin/siswa-ajax', IndexController::class.'@siswaAjax')->name('siswa-ajax');
    Route::get('/admin/user-ajax', IndexController::class.'@userAjax')->name('user-ajax');


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

    Route::get('/admin/absensi/scan', AbsensiController::class.'@scan')->name('scan-absensi');
    Route::get('/admin/absensi/harian', AbsensiController::class.'@harian')->name('absensi-harian');
    Route::get('/admin/absensi/tambah', AbsensiController::class.'@tambah')->name('absensi-tambah');
    Route::post('/admin/absensi/tambah', AbsensiController::class.'@store')->name('absensi-store');
    Route::get('/admin/absensi/bulanan', AbsensiController::class.'@bulanan')->name('absensi-bulanan');
    Route::get('/admin/absensi/tahun-pelajaran', AbsensiController::class.'@tahunPelajaran')->name('absensi-tahun-pelajaran');

    Route::get('/admin/pembayaran/tambah', AbsensiController::class.'@tambah')->name('pembayaran-tambah');
});

Route::get('/qrcode', IndexController::class.'@qrcode');
