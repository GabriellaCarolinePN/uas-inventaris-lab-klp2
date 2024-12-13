@extends('layouts.dashboard')

@section('title', 'Data Peminjam')

@section('header', 'Data Peminjam')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#peminjamanTable',{
                oLanguage: {
                    sLengthMenu: "Tampilkan _MENU_ data per halaman",
                    sZeroRecords: "Data tidak ditemukan",
                    sSearch: "Cari:",
                },
                pageLength: 50
            });
        })
    </script> 
@endpush

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Data Peminjam</h2>
    </div>

    @if (@session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-header">
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Jenis Peminjam</th>
                    <th>NIP/NIM</th>
                    <th>Kontak</th>
                    <th>Nama Alat</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->nama_peminjam }}</td>
                    <td>{{ $row->jenis_peminjam }}</td>
                    <td>{{ $row->nip_nim }}</td>
                    <td>{{ $row->kontak }}</td>
                    <td>{{ $row->nama_alat ?? 'N/A' }}</td>
                    <td>{{ $row->tanggal_peminjaman }}</td>
                    <td>{{ $row->tanggal_pengembalian }}</td>
                    <td>
                        <span class="badge {{ $row->status === 'Dipinjam' ? 'bg-not-available' : 'bg-available' }}">
                            {{ $row->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#edit{{ $row->id }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete{{ $row->id }}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection