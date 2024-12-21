@extends('layouts.dashboard')

@section('title', isset($inventori) ? 'Edit Inventaris' : 'Tambah Inventaris')

@section('header', isset($inventori) ? 'Edit Inventaris' : 'Tambah Inventaris')

@section('content')
<div class="container my-5">
    <h2 class="text-center title">{{ isset($inventori) ? 'Edit Inventaris' : 'Tambah Inventaris' }}</h2>
    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ isset($inventori) ? route('updateInventori', $inventori->id) : route('addInventori') }}" method="POST" class="equipment-form">
                @csrf
                @if(isset($inventori))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="kode_alat" class="form-label">Kode Alat</label>
                    <input type="text" class="form-control" id="kode_alat" name="kode_alat" pattern="[A-Z]{3}[0-9]{3}" placeholder="Masukkan Kode Alat" 
                        value="{{ old('kode_alat', $inventori->kode_alat ?? '') }}" 
                        {{ isset($inventori) ? 'readonly' : '' }} 
                        title="Kode alat harus terdiri dari 3 huruf besar di awal dan 3 angka di akhir">
                </div>

                <div class="mb-3">
                    <label for="nama_alat" class="form-label">Nama Alat</label>
                    <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Masukkan Nama Alat" value="{{ old('nama_alat', $inventori->nama_alat ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan Deskripsi Alat">{{ old('deskripsi', $inventori->deskripsi ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" value="{{ old('jumlah', $inventori->jumlah ?? '') }}">
                </div>

                <button type="submit" class="btn submit-btn">{{ isset($inventori) ? 'Update' : 'Simpan' }}</button>
                <a href="{{ route('inventoris')}}" class="btn cancel-btn">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
