<div class="modal fade" id="detailpeminjam{{ $row->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient" style="background-color: #48BEC8; color: white;">
                <h1 class="modal-title fs-5 fw-bold text-center w-100" id="modalLabel">Detail Peminjam</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="modalTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                            Informasi Umum
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="false">
                            File & Status
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="modalTabsContent">
                    <!-- Tab 1: Informasi Umum -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78; width: 30%;">Nama Peminjam</th>
                                    <td class="text-start">{{ $row->nama_peminjam }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Alat</th>
                                    <td class="text-start">{{ $row->nama_alat }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Jumlah Alat</th>
                                    <td class="text-start">{{ $row->jumlah_alat }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Tanggal Peminjaman</th>
                                    <td class="text-start">{{ $row->tanggal_peminjaman }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Tanggal Pengembalian</th>
                                    <td class="text-start">{{ $row->tanggal_pengembalian }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab 2: File & Status -->
                    <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78; width: 30%;">File</th>
                                    <td class="text-start">{{ $row->file }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Status</th>
                                    <td class="text-start">{{ $row->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
