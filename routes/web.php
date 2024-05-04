<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, AuthController, UserController};

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

Route::get('/', IndexController::class.'@index');
Route::get('/login', AuthController::class.'@login')->name('login');
Route::post('/login', AuthController::class.'@auth')->name('auth');
Route::get('/register', AuthController::class.'@register')->name('register');
Route::post('/register', AuthController::class.'@store')->name('register-store');
Route::get('/logout', AuthController::class.'@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', IndexController::class.'@dashboard')->name('dashboard');
    Route::get('/admin/user', UserController::class.'@index')->name('data-user');
});

Route::get('/qrcode', IndexController::class.'@qrcode');
