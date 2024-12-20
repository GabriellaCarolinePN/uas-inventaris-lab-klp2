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
    
        // Ambil data inventaris
        $inventoris = Inventaris::all();
        return view('user.menu', [
            'images' => $images,
            'inventoris' => $inventoris
        ]);
    
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
            'jumlah_alat' => 'required|integer|min:1',
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

        $alat = Inventaris::findOrFail($data['inventory_id']);
        if ($alat->jumlah < $data['jumlah_alat']) {
            return redirect()->back()->withInput()->with('error', 'Stok alat tidak mencukupi!');
        }
        
        $jumlahalat = $alat['jumlah'] - $data['jumlah_alat'];
        
        // Kurangi jumlah alat
        try {
            // Simpan data peminjaman ke database
            Peminjam::create($data);

            // Update jumlah dan status ketersediaan alat
            $alat->update([
                'jumlah' => $jumlahalat,
                'status_ketersediaan' => $jumlahalat === 0 ? 'tidak tersedia' : 'tersedia',
            ]);
        } catch (\Exception $e) {
            // Jangan menyimpan objek $e ke sesi
            return redirect()->back()->with('error', 'Terjadi kesalahan pada sistem. Silakan coba lagi.')->withInput();
        }

        return redirect()->route('home')->with('success', 'Data Peminjaman berhasil diinput');
    }    
    
    public function addPeminjamanmhs(Request $request) {
        // Validasi data form
        $globalValidatorData = [
            'nama_peminjam' => 'required',
            'jenis_peminjam' => 'required',
            'kontak' => 'required',
            'inventory_id' => 'required',
            'jumlah_alat' => 'required|integer|min:1',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
            'surat' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Maksimum 2MB
        ];
    
        $globalValidator = Validator::make($request->all(), $globalValidatorData);
        
        // Validasi input awal
        if ($globalValidator->fails()) {
            return redirect()->back()->withErrors($globalValidator)->withInput();
        }
    
        // Ambil data dari request
        $data = $request->except('surat'); // Kecuali file surat, simpan data lain dulu
        $data['status'] = "belum kembali";
    
        // Validasi tanggal
        $tanggalPeminjaman = new \DateTime($data['tanggal_peminjaman']);
        $tanggalPengembalian = new \DateTime($data['tanggal_pengembalian']);
        $interval = $tanggalPeminjaman->diff($tanggalPengembalian)->days;
    
        if ($interval > 7) {
            return redirect()->back()->withInput()->with('error', 'Tanggal pengembalian tidak boleh lebih dari 7 hari sejak tanggal peminjaman!');
        }

        $alat = Inventaris::findOrFail($data['inventory_id']);
        if ($alat->jumlah < $data['jumlah_alat']) {
            return redirect()->back()->withInput()->with('error', 'Stok alat tidak mencukupi!');
        }
        
        $jumlahalat = $alat['jumlah'] - $data['jumlah_alat'];
    
        try {
            // Simpan data peminjaman ke database
            $peminjaman = Peminjam::create($data);

             // Update jumlah dan status ketersediaan alat
            $alat->update([
                'jumlah' => $jumlahalat,
                'status_ketersediaan' => $jumlahalat === 0 ? 'tidak tersedia' : 'tersedia',
            ]);
    
            // Jika data berhasil disimpan, unggah file surat
            if ($request->hasFile('surat')) {
                $file = $request->file('surat');
                $nama_file = time() . "_" . $file->getClientOriginalName();
    
                // Upload file ke folder public/surat
                $file->move(public_path('surat'), $nama_file);
    
                // Simpan nama file surat ke database
                $peminjaman->update(['surat' => $nama_file]);
            }
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan pada sistem. Silakan coba lagi.');
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    
        return redirect()->route('home')->with('success', 'Data Peminjaman berhasil diinput');
    }        
}