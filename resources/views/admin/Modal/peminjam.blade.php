<div class="modal fade" id="detailpeminjam{{ $row->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $row->id }}">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient" style="background-color: #48BEC8; color: white;">
                <h1 class="modal-title fs-5 fw-bold text-center w-100" id="modalLabel{{ $row->id }}">Detail Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="modalTabs{{ $row->id }}" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab-{{ $row->id }}" data-bs-toggle="tab" data-bs-target="#info-{{ $row->id }}" type="button" role="tab" aria-controls="info-{{ $row->id }}" aria-selected="true">
                            Informasi Umum
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="file-tab-{{ $row->id }}" data-bs-toggle="tab" data-bs-target="#file-{{ $row->id }}" type="button" role="tab" aria-controls="file-{{ $row->id }}" aria-selected="false">
                            File & Status
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="modalTabsContent{{ $row->id }}">
                    <!-- Tab 1: Informasi Umum -->
                    <div class="tab-pane fade show active" id="info-{{ $row->id }}" role="tabpanel" aria-labelledby="info-tab-{{ $row->id }}">
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
                    <div class="tab-pane fade" id="file-{{ $row->id }}" role="tabpanel" aria-labelledby="file-tab-{{ $row->id }}">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78; width: 30%;">File Surat</th>
                                    <td class="text-start">
                                        @if(!empty($row->surat))
                                            <a href="{{ asset('surat/' . $row->surat) }}" class="btn btn-primary" target="_blank">Lihat File</a>
                                        @else
                                            <p style="color: red;">File surat tidak tersedia.</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start" style="color: #FAAF78;">Status</th>
                                    <td class="text-start">
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>