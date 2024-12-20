@extends('layouts.home')

@section('content')
<?php
    $today = date('Y-m-d'); // Tanggal hari ini (format YYYY-MM-DD)
?>

<h1>Form Peminjaman</h1>

<!-- Pills Navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tab-dosen-staff" data-mdb-target="#pills-dosen-staff" data-bs-toggle="pill"
       href="#pills-dosen-staff" role="tab" aria-controls="pills-dosen-staff" aria-selected="true">
      Dosen/Staff
    </a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-mahasiswa" data-mdb-target="#pills-mahasiswa" data-bs-toggle="pill"
       href="#pills-mahasiswa" role="tab" aria-controls="pills-mahasiswa" aria-selected="false">
      Mahasiswa
    </a>
  </li>
</ul>
  <!-- Pills navs -->
  
  <!-- Pills content -->
  <div class="tab-content">
    <!-- Form Dosen/Staff -->
    <div class="tab-pane fade show active" id="pills-dosen-staff" role="tabpanel" aria-labelledby="tab-dosen-staff">
      <form action="{{ route('peminjaman-dosen')}}" method="POST">
        @csrf
        <!-- Nama -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="namaDosen">Nama</label>
          <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control" required />
        </div>

        <!-- Jenis Peminjam -->
        <div data-mdb-input-init class="form-outline mb-4">
          <input required type="hidden" class="form-control" name="jenis_peminjam" id="jenis_peminjam" value="dosen" placeholder="">
        </div>
  
        <!-- NIP -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="nipDosen">NIP</label>
          <input type="text" id="nip_nim" name="nip_nim" class="form-control" pattern="[0-9]{18}" required />
        </div>
  
        <!-- Kontak -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="kontakDosen">No WhatsApp (Contoh: 08123456789)</label>
          <input type="tel" id="kontak" name="kontak" class="form-control" required />
        </div>
  
        <!-- Pilih Alat -->
        <div class="mb-4">
          <label for="alatDosen" class="form-label">Pilih Alat</label>
          <select id="inventory_id" name="inventory_id" class="form-select" required>
            <option value="">Pilih Alat</option>
            @foreach ($alat as $a)
              <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
            @endforeach
          </select>
        </div>

        <!-- Jumlah alat yang dipinjam -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="jumlahalatDosen">Jumlah Alat</label>
          <input type="number" id="jumlah_alat" name="jumlah_alat" class="form-control" min="1" required />
        </div>
  
        <!-- Tanggal Peminjaman & Pengembalian -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="tglPinjamDosen" class="form-label">Tanggal Peminjaman</label>
            <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" class="form-control" min="<?= $today; ?>" required />
          </div>
          <div class="col-md-6">
            <label for="tglKembaliDosen" class="form-label">Tanggal Pengembalian</label>
            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control" min="<?= $today ?>" required />
          </div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Ajukan Peminjaman</button>
      </form>
    </div>
  
    <!-- Form Mahasiswa -->
    <div class="tab-pane fade" id="pills-mahasiswa" role="tabpanel" aria-labelledby="tab-mahasiswa">
      <form action="{{ route('peminjaman-mhs')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Nama -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="namaMhs">Nama</label>
          <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control" required />
        </div>

        <!-- Jenis Peminjam -->
        <div data-mdb-input-init class="form-outline mb-4">
          <input required type="hidden" class="form-control" name="jenis_peminjam" id="jenis_peminjam" value="mahasiswa" placeholder="">
        </div>
  
        <!-- NIM -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="nimMhs">NIM</label>
          <input type="text" id="nip_nim" name="nip_nim" class="form-control" pattern="[A-Z]{1}[0-9]{7}" required />
        </div>
  
        <!-- Kontak -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="kontakMhs">No WhatsApp (Contoh: 08123456789)</label>
          <input type="tel" id="kontak" name="kontak" class="form-control" required />
        </div>
  
        <!-- Pilih Alat -->
        <div class="mb-4">
          <label for="alatMhs" class="form-label">Pilih Alat</label>
          <select id="inventory_id" name="inventory_id" class="form-select" required>
            <option value="">Pilih Alat</option>
            @foreach ($alat as $a)
              <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
            @endforeach
          </select>
        </div>

        <!-- Jumlah Alat -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="jumlahAlatMhs">Jumlah Alat</label>
          <input type="number" id="jumlah_alat" name="jumlah_alat" class="form-control" min="1" required />
        </div>

        <!-- Upload File -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="fileUploadMhs">Upload File</label>
          <input type="file" id="surat" name="surat" class="form-control"/>
        </div>
  
        <!-- Tanggal Peminjaman & Pengembalian -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="tglPinjamMhs" class="form-label">Tanggal Peminjaman</label>
            <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" class="form-control" min="<?= $today; ?>" required />
          </div>
          <div class="col-md-6">
            <label for="tglKembaliMhs" class="form-label">Tanggal Pengembalian</label>
            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control" min="<?= $today ?>" required />
          </div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Ajukan Peminjaman</button>
      </form>
    </div>
  </div>
  <!-- Pills content -->
  @endsection
