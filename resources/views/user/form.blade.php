@extends('layouts.home')

@section('content')

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
      <form>
        <!-- Nama -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="namaDosen">Nama</label>
          <input type="text" id="namaDosen" class="form-control" required />
        </div>
  
        <!-- NIP -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="nipDosen">NIP</label>
          <input type="text" id="nipDosen" class="form-control" required />
        </div>
  
        <!-- Kontak -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="kontakDosen">Kontak</label>
          <input type="tel" id="kontakDosen" class="form-control" required />
        </div>
  
        <!-- Pilih Alat -->
        <div class="mb-4">
          <label for="alatDosen" class="form-label">Pilih Alat</label>
          <select id="alatDosen" class="form-select" required>
            <option value="">-- Pilih Alat --</option>
            <option value="Laptop">Laptop</option>
            <option value="Proyektor">Proyektor</option>
            <option value="Kamera">Kamera</option>
          </select>
        </div>
  
        <!-- Tanggal Peminjaman & Pengembalian -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="tglPinjamDosen" class="form-label">Tanggal Peminjaman</label>
            <input type="date" id="tglPinjamDosen" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="tglKembaliDosen" class="form-label">Tanggal Pengembalian</label>
            <input type="date" id="tglKembaliDosen" class="form-control" required />
          </div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Ajukan Peminjaman</button>
      </form>
    </div>
  
    <!-- Form Mahasiswa -->
    <div class="tab-pane fade" id="pills-mahasiswa" role="tabpanel" aria-labelledby="tab-mahasiswa">
      <form>
        <!-- Nama -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="namaMhs">Nama</label>
          <input type="text" id="namaMhs" class="form-control" required />
        </div>
  
        <!-- NIM -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="nimMhs">NIM</label>
          <input type="text" id="nimMhs" class="form-control" required />
        </div>
  
        <!-- Kontak -->
        <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="kontakMhs">Kontak</label>
          <input type="tel" id="kontakMhs" class="form-control" required />
        </div>
  
        <!-- Pilih Alat -->
        <div class="mb-4">
          <label for="alatMhs" class="form-label">Pilih Alat</label>
          <select id="alatMhs" class="form-select" required>
            <option value="">-- Pilih Alat --</option>
            <option value="Laptop">Laptop</option>
            <option value="Proyektor">Proyektor</option>
            <option value="Kamera">Kamera</option>
          </select>
        </div>
  
        <!-- Tanggal Peminjaman & Pengembalian -->
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="tglPinjamMhs" class="form-label">Tanggal Peminjaman</label>
            <input type="date" id="tglPinjamMhs" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label for="tglKembaliMhs" class="form-label">Tanggal Pengembalian</label>
            <input type="date" id="tglKembaliMhs" class="form-control" required />
          </div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Ajukan Peminjaman</button>
      </form>
    </div>
  </div>
  <!-- Pills content -->
  @endsection
