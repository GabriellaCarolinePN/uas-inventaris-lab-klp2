<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    
        $startDate = now()->subDays(7)->startOfDay();
        $endDate = now()->endOfDay();
    
        $statistikRiwayat = Inventaris::with(['peminjaman' => function ($query) use ($startDate, $endDate) {
            $query->selectRaw("
                    inventory_id, 
                    DATE(created_at) as date, 
                    COUNT(*) as aggregate
                ")
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('inventory_id', 'date')
                ->orderBy('date', 'asc');
        }])->get();
    
        // Buat array tanggal (labels) dari $startDate hingga $endDate
        $labels = collect();
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $labels->push($date->format('Y-m-d'));
        }
    
        // Data untuk grafik
        $datasets = [];
        $colors = [
            ['border' => 'rgb(255, 99, 132)', 'background' => 'rgba(255, 99, 132, 0.3)'],
            ['border' => 'rgb(54, 162, 235)', 'background' => 'rgba(54, 162, 235, 0.3)'],
            ['border' => 'rgb(75, 192, 192)', 'background' => 'rgba(75, 192, 192, 0.3)'],
            ['border' => 'rgb(255, 206, 86)', 'background' => 'rgba(255, 206, 86, 0.3)'],
            ['border' => 'rgb(153, 102, 255)', 'background' => 'rgba(153, 102, 255, 0.3)'],
            ['border' => 'rgb(255, 159, 64)', 'background' => 'rgba(255, 159, 64, 0.3)'],
        ];
    
        foreach ($statistikRiwayat as $index => $inventaris) {
            $data = $labels->map(function ($label) use ($inventaris) {
                // Cari jumlah peminjaman sesuai tanggal, atau 0 jika tidak ada data
                $peminjaman = $inventaris->peminjaman->firstWhere('date', $label);
                return $peminjaman ? $peminjaman->aggregate : 0;
            });
    
            $datasets[] = [
                'label' => $inventaris->nama_alat,
                'data' => $data->toArray(),
                'borderColor' => $colors[$index % count($colors)]['border'],
                'backgroundColor' => $colors[$index % count($colors)]['background'],
            ];
        }
    
        $data = [
            'colors' => $colors,
            'riwayatTerbaru' => $riwayatTerbaru,
            'jumlahInventaris' => $jumlahInventaris,
            'labels' => $labels,
            'datasets' => $datasets,
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

