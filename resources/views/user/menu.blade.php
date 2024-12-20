@extends('layouts.home')

@section('content')
<!-- Carousel Section -->
<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($images as $index => $image)
            <div class="carousel-item @if($index == 0) active @endif banner" style="background: url('{{ $image }}') center/cover;">
                <div class="overlay"></div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center text-white">
                    <h1 class="display-4 fw-bold text-highlight">
                        <span class="">Selamat Datang</span> di <br> Sistem Informasi <span class="">Peminjaman Inventori Lab</span>
                    </h1>

                    <a href="#barangTersedia" class="btn btn-lht btn-lg mt-4">
                        S&K Peminjaman
                    </a>
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
    <h3 class="text-center mb-4 fw-bold section-title" id="barangTersedia">Barang yang Tersedia</h3>
    <table class="table table-bordered text-center">
        <thead class="table-header">
            <tr>
                <th>No.</th>
                <th>Nama Alat</th>
                <th>Jumlah Alat</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($inventoris as $key => $row)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $row->nama_alat }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>
                        @php
                            switch($row->status_ketersediaan){
                                case'tersedia':
                                    echo"<span class='btn btn-success btn-sm'>Tersedia</span>";
                                    break;
                                case'tidak tersedia':
                                    echo"<span class='btn btn-secondary btn-sm'>Tidak Tersedia</span>";
                                    break;
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-center mb-4 fw-bold section-title">Syarat dan Ketentuan Peminjaman</h3>
    <div class="terms-box p-4 rounded">
        <p style="text-align: justify;">
            1. Mahasiswa wajib mengisi formulir peminjaman sesuai dengan ketentuan yang berlaku.<br>
            2. Peminjaman hanya diperbolehkan untuk mahasiswa PTIK. Mahasiswa non-PTIK harus menyertakan surat peminjaman yang ditandatangani oleh dosen terkait.<br>
            3. Mahasiswa yang meminjam barang wajib menggunakan Kartu Mahasiswa.<br>
            4. Barang yang dapat dipinjam meliputi peralatan praktikum seperti router, proyektor, access point, kabel LAN, dan sejenisnya, serta ruangan laboratorium seperti Lab A, Lab Jaringan, dan Lab Multimedia.<br>
            5. Peminjaman di luar kegiatan praktikum mata kuliah harus disertai surat peminjaman yang ditandatangani oleh Kepala Laboratorium.<br>
            6. Peminjam bertanggung jawab atas barang atau ruangan yang dipinjam selama masa peminjaman. Jika terjadi kerusakan atau kehilangan, peminjam wajib mengganti barang sesuai dengan tipe dan spesifikasi yang sama.<br>
        </p>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('form') }}" class="btn btn-custom btn-lg">Pinjam Sekarang</a>
    </div>
</div>

@endsection