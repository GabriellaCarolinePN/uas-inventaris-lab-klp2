@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('header', '')

@push('scripts')
    <script>
        const colors = @json($colors);
        const labels = @json($labels);
        const datasets = @json($datasets);

        const data = {
            labels: labels,
            datasets: datasets,
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Alat Dipinjam',
                        },
                    },
                },
            },
        };

        const myChart = new Chart(
            document.getElementById('chartPeminjaman'),
            config
        );
    </script>
@endpush

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card welcome-card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">Welcome Admin</h5>
            <p class="card-text fs-6">Selamat Datang di halaman Admin, tempat Anda dapat mengelola inventaris dan memperbarui riwayat peminjaman dengan mudah. <br> Gunakan fitur yang tersedia untuk memastikan segala proses berjalan lancar.</p>
        </div>
    </div>

    <!-- Feature Cards and Chart -->
    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('inventoris') }}" class="text-decoration-none text-dark">
                <div class="card feature-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="icon bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h6 class="card-title">Inventaris</h6>
                            <p class="card-text mb-1">Jumlah Item: <strong>{{ $jumlahInventaris }}</strong></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('riwayat') }}" class="text-decoration-none text-dark">
                <div class="card feature-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="icon bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h6 class="card-title">Riwayat</h6>
                            <p class="card-text mb-1">Peminjam Hari Ini: <strong>{{ $riwayatTerbaru }}</strong></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card welcome-card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">Statistik Peminjaman Minggu Ini</h5>
                <canvas id="chartPeminjaman"></canvas>
            </div>
        </div>
    </div>
@endsection