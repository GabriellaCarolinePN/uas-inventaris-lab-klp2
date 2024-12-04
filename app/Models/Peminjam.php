<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $fillable = ['nama_peminjam', 'jenis_peminjam', 'kontak', 'inventory_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'status'];

    public function inventory()
    {
        return $this->belongsTo(Inventaris::class, 'inventory_id', 'id');
    }

}
