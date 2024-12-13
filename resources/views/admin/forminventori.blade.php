@extends('layouts.dashboard')

@section('title', 'Inventoris')

@section('header', 'Inventoris')

@section('content')
<div class="container my-5">
    <h2 class="text-center title">Inventori</h2>
    <div class="card shadow-lg">
        <div class="card-body">
            <form action="#" method="POST" class="equipment-form">
                @csrf
                <div class="mb-3">
                    <label for="kode_alat" class="form-label">Kode Alat</label>
                    <input type="text" class="form-control" id="kode_alat" name="kode_alat" placeholder="Masukkan Kode Alat">
                </div>

                <div class="mb-3">
                    <label for="nama_alat" class="form-label">Nama Alat</label>
                    <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Masukkan Nama Alat">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan Deskripsi Alat"></textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah">
                </div>

                <button type="submit" class="btn submit-btn">Simpan</button>
                <button type="reset" class="btn cancel-btn">Batal</button>
            </form>
        </div>
    </div>
</div>
@endsection
