<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white mb-4">Admin Panel</h4>
        <a href="#" class="active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="#"><i class="fas fa-boxes me-2"></i>Inventori</a>
        <a href="#"><i class="fas fa-user-friends me-2"></i>Data Peminjam</a>
        <a href="#"><i class="fas fa-history me-2"></i>Riwayat</a>
        <a href="#"><i class="fas fa-cogs me-2"></i>Opsi</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome Admin</h2>
            <div class="dropdown profile-dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i> Admin
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang di Dashboard Admin</h5>
                <p class="card-text">Gunakan panel navigasi untuk mengelola data Anda.</p>
            </div>
        </div>
    
        <!-- Dashboard Cards Section -->
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
        <!-- SweetAlert Notification -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    showConfirmButton: false,
                });
            </script>
        @endif
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
