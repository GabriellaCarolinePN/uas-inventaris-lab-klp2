<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Inventaris;
use App\Models\Peminjam;
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
Route::get('/form-peminjaman', [UserController::class, 'formPeminjaman'])->name('form');
Route::post('/form-peminjaman/dosen', [UserController::class, 'addPeminjamandosen'])->name('peminjaman-dosen');
Route::post('/form-peminjaman/mahasiswa', [UserController::class, 'addPeminjamanmhs'])->name('peminjaman-mhs');

//Akses admin
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin', function () {
        $today = date('Y-m-d');

        $riwayatTerbaru = Peminjam::whereDate('created_at', $today)->count();
        $jumlahInventaris = Inventaris::count();

        $data = [
            'riwayatTerbaru' => $riwayatTerbaru,
            'jumlahInventaris' => $jumlahInventaris,
        ];

        return view('admin.dashboard', $data);
    })->name('dashboard');

    //Inventori
    Route::get('/admin/inventoris', [AdminController::class, 'inventoris'])->name('inventoris');
    Route::get('/admin/inventoris/form', function () {
        return view('admin.forminventori');})
    ->name('forminventori');
    Route::post('/admin/inventoris/form', [AdminController::class, 'addInventoris'])->name('addInventori');
    Route::get('/admin/inventoris/form/{id}', [AdminController::class, 'editInventoris'])->name('editInventori');
    Route::put('/admin/inventoris/form/{id}', [AdminController::class, 'updateInventoris'])->name('updateInventori');
    Route::delete('/admin/inventoris/{id}', [AdminController::class, 'deleteInventoris'])->name('deleteInventori');


    Route::get('/admin/riwayat-peminjaman', [AdminController::class, 'riwayatpeminjaman'])->name('riwayat');
    Route::get('/admin/riwayat-peminjaman/surat/{filename}', function ($filename) {
        $path = public_path('surat/' . $filename);
    
        if (file_exists($path)) {
            $mimeType = mime_content_type($path); // Dapatkan MIME type
            return response()->file($path, [
                'Content-Type' => $mimeType,
            ]);
        }
    
        abort(404, 'File tidak ditemukan');
    });
    Route::post('/admin/riwayat-peminjaman/{id}/status', [AdminController::class, 'updateStatuspeminjaman'])->name('statusRiwayat');
});

