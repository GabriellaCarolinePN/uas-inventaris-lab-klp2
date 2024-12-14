<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $fillable = ['nama_peminjam', 'jenis_peminjam', 'nip_nim', 'kontak', 'inventory_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'status'];
    protected $table = 'peminjam';

    public function inventory()
    {
        return $this->belongsTo(Inventaris::class, 'inventory_id', 'id');
    }

    public function getNamaAlatAttribute()
    {
        return $this->inventory->nama_alat ?? 'Tidak ada data';
    }


}
