@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('header', 'Welcome Admin')

@section('content')
    <div class="card welcome-card mb-4">
        <div class="card-body">
            <h5 class="card-title">Selamat Datang di Dashboard Admin</h5>
            <p class="card-text">Gunakan panel navigasi untuk mengelola data Anda.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body">
                    <h6 class="card-title">Riwayat</h6>
                    <p class="card-text">Lihat aktivitas terbaru yang telah dilakukan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body">
                    <h6 class="card-title">Inventori</h6>
                    <p class="card-text">Kelola data inventori Anda dengan mudah.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card feature-card">
                <div class="card-body">
                    <h6 class="card-title">Data Peminjam</h6>
                    <p class="card-text">Cek status peminjam terbaru di sistem.</p>
                </div>
            </div>
        </div>
    </div>
@endsection