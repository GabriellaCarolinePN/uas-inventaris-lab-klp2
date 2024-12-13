<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class AdminController extends Controller
{
    public function datapeminjam()
    {
        $peminjaman = Peminjam::with('inventory')->get();
        return view('admin.datapeminjam', compact('peminjaman'));
    }

}
