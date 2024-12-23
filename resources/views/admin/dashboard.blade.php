@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('header', 'Welcome Admin')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card welcome-card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">Welcome Admin</h5>
            <p class="card-text">Selamat datang di halaman Admin, tempat Anda dapat mengelola inventaris dan memperbarui riwayat peminjaman dengan mudah. <br> Gunakan fitur yang tersedia untuk memastikan segala proses berjalan lancar.</p>
        </div>
    </div>

    <!-- Feature Cards and Chart -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card feature-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="icon bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Inventaris</h6>
                        <p class="card-text mb-1">Jumlah Item: <strong>120</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card feature-card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="icon bi bi-clock-history"></i>
                    </div>
                    <div>
                        <h6 class="card-title">Riwayat</h6>
                        <p class="card-text mb-1">Peminjam Hari Ini: <strong>15</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection