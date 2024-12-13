<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

Route::get('/', [UserController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Form Peminjaman User
Route::get('/form-peminjaman', function () {
    return view('user.form');
})->name('form');

//Akses admin
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //Inventori
    Route::get('/admin/inventoris', function () {
        return view('admin.inventoris');
    })->name('inventoris');
    Route::get('/admin/inventoris/form', function () {
        return view('admin.forminventori');})
    ->name('forminventoris');

    Route::get('/admin/riwayat-peminjaman', function () {
        return view('admin.riwayat');
    })->name('riwayat');
    Route::get('/admin/data-peminjam', [AdminController::class, 'datapeminjam'])->name('data-peminjam');
});

//Akses admin -> tabel peminjam
Route::get('/datapeminjam', [AdminController::class, 'datapeminjam']);

//Akses admin -> tabel inventori
Route::get('/admin/inventoris', [AdminController::class, 'inventoris'])->name('inventoris');