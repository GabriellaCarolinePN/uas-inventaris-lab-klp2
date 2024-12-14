<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Peminjam;
use App\Models\Inventaris;

class UserController extends Controller
{
    public function index() {
        $imagePath = public_path('image');
        $images = collect(File::files($imagePath))
                    ->map(function ($file) {
                        return asset('image/' . $file->getFilename());
                    });
        return view('user.menu', ['images' => $images]);
    }

    public function formPeminjaman(){
        $alat = Inventaris::all();

        return view('user.form', ['alat' => $alat]);
    }

    public function addPeminjamandosen(Request $request) {
        $globalValidatorData = [
            'nama_peminjam' => 'required',
            'jenis_peminjam' => 'required',
            'kontak' => 'required',
            'inventory_id' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
        ];
    
        $globalValidator = Validator::make($request->all(), $globalValidatorData);
        
        // Validasi input awal
        if ($globalValidator->fails()) {
            return redirect()->back()->withErrors($globalValidator)->withInput();
        }
    
        // Ambil data dari request
        $data = $request->all();
        $data['status'] = "belum kembali";

        $tanggalPeminjaman = new \DateTime($data['tanggal_peminjaman']);
        $tanggalPengembalian = new \DateTime($data['tanggal_pengembalian']);
        $interval = $tanggalPeminjaman->diff($tanggalPengembalian)->days;

        if ($interval > 7) {
            return redirect()->back()->withInput()->with('error', 'Tanggal pengembalian tidak boleh lebih dari 7 hari sejak tanggal peminjaman!');
        }
        
        // Kurangi jumlah alat
        try {
            $alat = Inventaris::findOrFail($data['inventory_id']);
            if ($alat->jumlah <= 0) {
                return redirect()->back()->withInput()->with('error', 'Stok alat tidak mencukupi!');
            }
    
            $jumlahalat = $alat->jumlah - 1;
    
            // Simpan data peminjaman dan update inventaris
            $peminjaman = Peminjam::create($data);
            $alat->update(['jumlah' => $jumlahalat]);
        } catch (Exception $e) {
            Alert::error('Gagal!', 'Cek pada form inventoris apakah ada kesalahan yang terjadi.');
            return redirect()->back()->withError($e)->withInput();
        }
    
        return redirect()->route('home')->with('success', 'Data Peminjaman berhasil diinput');
    }    
}
