@extends('layouts.home')

@section('content')
<!-- Carousel Section -->
<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($images as $index => $image)
            <div class="carousel-item @if($index == 0) active @endif banner" style="background: url('{{ $image }}') center/cover;">
                <div class="overlay"></div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center text-white">
                    <h1 class="display-4 fw-bold text-typing">
                        <span id="typing-text"></span>
                    </h1>
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#homeCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#homeCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>

<!-- Content Section -->
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold section-title">Syarat dan Ketentuan Peminjaman</h2>
    <div class="terms-box p-4 rounded">
        <p class="text-justify">
            1. Peminjaman hanya diperbolehkan untuk pengguna terdaftar.<br>
            2. Barang harus dikembalikan tepat waktu sesuai jadwal yang ditentukan.<br>
            3. Kerusakan atau kehilangan akan dikenakan biaya sesuai ketentuan.<br>
            4. Peminjam bertanggung jawab atas barang yang dipinjam selama masa peminjaman.<br>
        </p>
    </div>

    <div class="text-center mt-4">
        <!-- Ubah ke URL Dummy -->
        <a href="{{ route('form') }}" class="btn btn-custom btn-lg">Pesan Sekarang</a>
    </div>
</div>

@endsection

<!-- Typing Text Script -->
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const textArray = ["Selamat Datang Admin"];
        let i = 0, j = 0, typingSpeed = 100;

        function typeEffect() {
            if (i < textArray.length) {
                if (j < textArray[i].length) {
                    document.getElementById("typing-text").innerHTML += textArray[i].charAt(j);
                    j++;
                    setTimeout(typeEffect, typingSpeed);
                }
            }
        }
        typeEffect();
    });
</script>
@endpush

