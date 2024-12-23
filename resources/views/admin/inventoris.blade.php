@extends('layouts.dashboard')

@section('title', '')

@section('header', '')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endpush

@push('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
		$(document).ready(function() {
			$('#tableInventori').dataTable();
		} );

        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Ingin menghapusnya?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
@endpush

@section('content')
        <div class="container table-container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Inventaris Peminjaman Lab</h2>
                <a class="btn btn-add" href="{{ route('forminventori') }}">+ Add Inventaris</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tableInventori">
                    <thead class="table-header">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Kode Alat</th>
                            <th class="text-center">Nama Alat</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Status Ketersediaan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventoris as $key => $row)
                            <tr>
                                <td class="text-center">{{ $row->id }}</td>
                                <td>{{ $row->kode_alat }}</td>
                                <td>{{ $row->nama_alat }}</td>
                                <td class="text-wrap">{{ $row->deskripsi }}</td>
                                <td class="text-center">{{ $row->jumlah }}</td>
                                <td class="text-center">
                                    @php
                                        switch($row->status_ketersediaan){
                                            case'tersedia':
                                                echo"<span class='badge bg-available'>Tersedia</span>";
                                                break;
                                            case'tidak tersedia':
                                                echo"<span class='badge bg-not-available'>Tidak Tersedia</span>";
                                                break;
                                        }
                                    @endphp
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('editInventori', $row->id) }}" class="btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('deleteInventori', $row->id) }}" method="POST" onsubmit="return confirmDelete(event)" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            
        </div>
@endsection