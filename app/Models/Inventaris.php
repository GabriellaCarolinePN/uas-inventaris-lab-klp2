<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = ['kode_alat', 'nama_alat', 'deskripsi', 'jumlah', 'status_ketersediaan'];
    protected $table = 'inventaris';

    public function peminjaman()
    {
        return $this->hasMany(Peminjam::class, 'inventory_id', 'id');
    }

}
