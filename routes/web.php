<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, AuthController, UserController, AbsensiController, SiswaController, JenisBayarController, KelasController};

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

Route::get('/', IndexController::class.'@index')->name('index');
Route::get('/login', AuthController::class.'@login')->name('login');
Route::post('/login', AuthController::class.'@auth')->name('auth');
Route::get('/register', AuthController::class.'@register')->name('register');
Route::post('/register', AuthController::class.'@store')->name('register-store');
Route::get('/logout', AuthController::class.'@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', IndexController::class.'@dashboard')->name('dashboard');


    Route::get('/admin/user', UserController::class.'@index')->name('admin.user');
    Route::post('/admin/user', UserController::class.'@store')->name('admin.user.store');
    Route::get('/admin/user/{user:id}/edit', UserController::class.'@edit')->name('admin.user.edit');
    Route::put('/admin/user/{user:id}/update', UserController::class.'@update')->name('admin.user.update');
    Route::delete('/admin/user/{user:id}/delete', UserController::class.'@destroy')->name('admin.user.delete');
    
    Route::get('/admin/absensi/scan', AbsensiController::class.'@scan')->name('scan-absensi');

    Route::resource('admin/siswa', SiswaController::class)
    ->name('index', 'admin.siswa')
    ->name('store', 'admin.siswa.store')
    ->name('edit', 'admin.siswa.edit')
    ->name('update', 'admin.siswa.update')
    ->name('destroy', 'admin.siswa.delete');
    
    Route::resource('admin/kelas', KelasController::class)
    ->name('index', 'admin.kelas')
    ->name('store', 'admin.kelas.store')
    ->name('edit', 'admin.kelas.edit')
    ->name('update', 'admin.kelas.update')
    ->name('destroy', 'admin.kelas.delete');

    Route::resource('admin/jenis-bayar', JenisBayarController::class)
    ->name('index', 'admin.jenis-bayar')
    ->name('store', 'admin.jenis-bayar.store')
    ->name('edit', 'admin.jenis-bayar.edit')
    ->name('update', 'admin.jenis-bayar.update')
    ->name('destroy', 'admin.jenis-bayar.delete');
});

Route::get('/qrcode', IndexController::class.'@qrcode');
