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

    public function inventoris()
    {
        $inventoris = \App\Models\Inventaris::all(); 
        return view('admin.inventoris', compact('inventoris'));
    }

}
