@extends('layouts.dashboard')

@section('title', 'Invetoris')

@section('header', 'Invetoris')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#inventoriTable',{
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
                <h2 class="fw-bold">Inventori Peminjaman Lab</h2>
                <a class="btn btn-add" href="{{ route('forminventoris') }}">+ Add Inventori</a>
            </div>

            @if (@session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Kode Alat</th>
                            <th>Nama Alat</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Status Ketersediaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventoris as $key => $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->kode_alat }}</td>
                                <td>{{ $row->nama_alat }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>
                                    <span class="badge {{ $row->status === 'Dipinjam' ? 'bg-not-available' : 'bg-available' }}">
                                        {{ $row->status_ketersediaan }}
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