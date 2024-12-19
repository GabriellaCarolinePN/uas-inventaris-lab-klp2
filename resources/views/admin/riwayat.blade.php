@extends('layouts.dashboard')

@section('title', 'Riwayat Peminjaman')

@section('header', 'Riwayat Peminjaman')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        }

        .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }
    </style>
@endpush

@push('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Include DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        function confirmStatus(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Konfirmasi!',
                text: "Apakah benar alat yang dipinjam sudah dikembalikan",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Ya, Benar!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Find the parent form of the clicked checkbox and submit it
                    const form = event.target.closest('form'); // Locate the closest form element
                    form.submit(); // Submit the form
                }
            });
        }
    </script> 
@endpush

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Riwayat Peminjaman</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-header">
                <tr>
                    <th>No</th>
                    <th>Jenis Peminjam</th>
                    <th>Nama Alat</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Sudah dikembalikan?</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $key => $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->jenis_peminjam }}</td>
                    <td>{{ $row->nama_alat ?? 'N/A' }}</td>
                    <td>{{ $row->tanggal_peminjaman }}</td>
                    <td>{{ $row->tanggal_pengembalian }}</td>
                    <td>
                        @php
                            switch($row->status){
                                case'belum kembali':
                                    echo"<span class='badge bg-not-available'>Belum Kembali</span>";
                                    break;
                                case'sudah kembali':
                                    echo"<span class='badge bg-available'>Sudah Kembali</span>";
                                    break;
                                }
                        @endphp
                    </td>
                    <td>
                        <a type="button" class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#detailpeminjam{{ $row->id }}" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        @include('admin.modal.peminjam', array('row' => $row))
                        <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete{{ $row->id }}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('statusRiwayat', $row->id) }}" method="POST">
                            @csrf
                            @if($row->status == "belum kembali")
                                <label class="switch">
                                    <input type="checkbox" onclick="confirmStatus(event)">
                                    <span class="slider round"></span>
                                </label>
                            @elseif($row->status == "sudah kembali")
                                <label class="switch">
                                    <input type="checkbox" disabled checked>
                                    <span class="slider round"></span>
                                </label>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection