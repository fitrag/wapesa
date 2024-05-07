<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, AuthController, UserController, AbsensiController, JenisBayarController};

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


    Route::get('/admin/user', UserController::class.'@index')->name('data-user');
    Route::post('/admin/user', UserController::class.'@store')->name('store-user');
    Route::get('/admin/user/{user:id}/edit', UserController::class.'@edit')->name('edit-user');
    Route::put('/admin/user/{user:id}/update', UserController::class.'@update')->name('update-user');
    Route::delete('/admin/user/{user:id}/delete', UserController::class.'@destroy')->name('delete-user');
    
    Route::get('/admin/absensi/scan', AbsensiController::class.'@scan')->name('scan-absensi');
    Route::resource('admin/jenis-bayar', JenisBayarController::class);
});

Route::get('/qrcode', IndexController::class.'@qrcode');
