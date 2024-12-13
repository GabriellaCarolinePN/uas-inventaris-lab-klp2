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
    <div class="row">
        <div class="col-lg-12 flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Data Peminjam</h5><br>
                    @if (@session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div><br>
                    @endif
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle" id="peminjamanTable">
                            <thead class="text-dark fs-4">
                                <tr style="background-color: #48BEC8">
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">No</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Nama Peminjam</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Jenis Peminjam</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">NIP/NIM</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Kontak</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Nama Alat</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Tanggal Peminjaman</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Tanggal Pengembalian</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Status</h6>
                                    </th>
                                    <th style="width: 100px" class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0 text-white">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($peminjaman as $key => $row)
                                <tr>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $key + 1 }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->nama_peminjam }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->jenis_peminjam }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->nip_nim }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->kontak }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->nama_alat ?? 'N/A' }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->tanggal_peminjaman }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->tanggal_pengembalian }} 
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $row->status }} 
                                        </h6>
                                    </td>   
                                    <td class="border-bottom-0 align-items-center text-center">
                                        <div class="row" style="width: 100px; margin: 0 auto">
                                            <div class="col-6 d-flex justify-content-center">
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $row->id }}" class="text-black text-center d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                {{-- @include('admin.modal.editPeminjaman', array('row' => $row)) --}}
                                            </div>
                                            <div class="col-6 d-flex justify-content-center">
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $row->id }}" class="text-black text-center d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                {{-- @include('admin.modal.deletePeminjaman', array('row' => $row)) --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection