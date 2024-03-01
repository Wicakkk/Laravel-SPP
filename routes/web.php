<?php

/*
|------------
| Web Routes
|------------
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Siswa;
use App\Http\Controllers\Spp;
use App\Http\Controllers\Petugas;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;



Route::get('/', function () {
    return view('login');
});

//login
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login/proses', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');

//edit dan hapus pembayaran
Route::get('/pembayaran', [Spp::class, 'index']);
Route::post('/pembayaran/save', [Spp::class, 'save']);
Route::put('/pembayaran/{id}', [Spp::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/{id}', [Spp::class, 'delete'])->name('pembayaran.delete');

// Reset password dengan username
Route::get('password/reset/{token}/{username}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');

// Reset password tanpa username
Route::get('password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');

// Request reset password
Route::get('password/reset', [PasswordController::class, 'showResetForm'])->name('password.request');

//edit profile
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


// Cetak Struk
Route::get('print-invoice/{id}', [InvoiceController::class, 'print'])->name('print.invoice');


Route::group(['middleware' => ['auth']], function () {
    Route::get('pembayaran', [Spp::class, 'index'])->name('pembayaran.index');
    Route::group(['middleware' =>['cekUserLogin:admin']], function () {
        Route::get('admin', [Admin::class, 'index'])->name('admin.index');
    });
    Route::group(['middleware' =>['cekUserLogin:siswa']], function () {
        Route::get('siswa', [Siswa::class, 'index'])->name('siswa.index');
    });
    Route::group(['middleware' => 'cekUserLogin:petugas'], function () {
        Route::get('petugas', [Petugas::class, 'index'])->name('petugas.index');
    });
});