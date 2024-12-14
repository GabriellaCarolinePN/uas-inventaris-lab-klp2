<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Peminjaman Alat Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/menu.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand custom-logo" href="#">Lab Tools</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto custom-nav-center">
                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('form') }}">Pemesanan</a>
                </li>
            </ul>
            
            <a class="btn btn-login" href="{{ route('login') }}">Login Admin</a>
        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="custom-footer text-center mt-5">
    <p>© 2024 Peminjaman Alat Lab | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert Notification -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@elseif (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@endif
</body>
</html>
