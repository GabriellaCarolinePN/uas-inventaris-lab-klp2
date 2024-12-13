@extends('layouts.dashboard')

@section('title', 'Invetoris')

@section('header', 'Invetoris')

@section('content')
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Inventori Peminjaman Lab</h2>
                <a class="btn btn-add" href="{{ route('forminventoris') }}">+ Add Inventori</a>
            </div>
        
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
                        <!-- Data Dummy -->
                        <tr>
                            <td>1</td>
                            <td>INV001</td>
                            <td>Laptop</td>
                            <td>Laptop Core i5</td>
                            <td>10</td>
                            <td><span class="badge bg-available">Tersedia</span></td>
                            <td>
                                <button class="btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-delete" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>INV002</td>
                            <td>Proyektor</td>
                            <td>Proyektor Full HD</td>
                            <td>5</td>
                            <td><span class="badge bg-not-available">Tidak Tersedia</span></td>
                            <td>
                                <button class="btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-delete" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection