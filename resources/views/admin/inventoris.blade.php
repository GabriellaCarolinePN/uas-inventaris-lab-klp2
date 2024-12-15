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
                <a class="btn btn-add" href="{{ route('forminventori') }}">+ Add Inventori</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-header">
                        <tr>
                            <th>No.</th>
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
                                <td>
                                    <a href="{{ route('editInventori', $row->id) }}" class="btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('deleteInventori', $row->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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

@push('scripts')
<script type="text/javascript">
    function confirmDelete(event) {
        event.preventDefault(); // Prevent form submission

        swal({
            title: 'Apakah Anda Yakin?',
            text: "Anda Tidak Akan Dapat Mengembalikannya!",
            icon: 'warning', // Updated property
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "btn btn-secondary",
                    closeModal: true,
                },
                confirm: {
                    text: "Ya, Hapus!",
                    value: true,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                }
            },
        }).then((willDelete) => {
            if (willDelete) {
                event.target.submit(); // Submit the form if confirmed
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush