<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Peminjam;
use App\Models\Inventaris;

class AdminController extends Controller
{
    public function riwayatpeminjaman()
    {
        $peminjaman = Peminjam::with('inventory')->orderByDesc('created_at')->get();
        return view('admin.riwayat', compact('peminjaman'));
    }

    public function inventoris()
    {
        $inventoris = Inventaris::all(); 
        return view('admin.inventoris', compact('inventoris'));
    }

    public function addInventoris (Request $request) {
        $globalValidatorData = [
            'kode_alat' => ['required', Rule::unique('inventaris', 'kode_alat')],
            'nama_alat' => ['required', Rule::unique('inventaris', 'nama_alat')],
            'deskripsi' => 'required',
            'jumlah' => 'required',
        ];

        $globalValidator = Validator::make($request->all(), $globalValidatorData);

        if ($globalValidator->fails()) {
            return redirect()->back()->with('error', 'Terdapat Kode atau Nama Alat yang Sama dalam data!!!')->withInput();
        }

        $data = $request->all();

        $data['status_ketersediaan'] = ($data['jumlah'] > 0) ? "tersedia" : "tidak tersedia";

        try{
            $inventaris = Inventaris::create($data);
        }
        catch(Exception $e){
            return redirect()->back()->withError($e)->withInput()->with('error', 'Cek pada form inventoris apakah ada kesalahan yang terjadi');
        }

        return redirect()->route('inventoris')->with('success', 'Inventaris berhasil ditambahkan');
    }

    public function editInventoris($id){
        $inventori = Inventaris::findOrFail($id);
        return view('admin.forminventori', compact('inventori'));
    }

    public function updateInventoris(Request $request, $id){
        $globalValidatorData = [
            'nama_alat' => ['required', Rule::unique('inventaris', 'nama_alat')->ignore($id)],
            'deskripsi' => 'required',
            'jumlah' => 'required',
        ];

        $globalValidator = Validator::make($request->all(), $globalValidatorData);

        if ($globalValidator->fails()) {
            return redirect()->back()->withErrors($globalValidator)->withInput();
        }

        $inventori = Inventaris::findOrFail($id);

        $inventori->update([
            'nama_alat' => $request->nama_alat,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'status_ketersediaan' => $request->jumlah > 0 ? 'tersedia' : 'tidak tersedia',
        ]);

        return redirect()->route('inventoris')->with('success', 'Inventaris berhasil diperbarui');
    }

    public function deleteInventoris($id){
        $inventori = Inventaris::findOrFail($id);
        $inventoridipakai = Peminjam::where('inventory_id', $id)->where('status', 'belum kembali')->exists();
        
        if($inventoridipakai){
            return redirect()->back()->with('error', 'Data Inventaris tidak dapat dihapus karena telah digunakan pada data lain!');
        }

        $inventori->delete();
        return redirect()->route('inventoris')->with('success', 'Data Inventaris berhasil dihapus');
    }

    public function updateStatuspeminjaman($id){
        $riwayat = Peminjam::findOrFail($id);
        $alat = Inventaris::findOrFail($riwayat['inventory_id']);

        $jumlahalat = $alat['jumlah'] + $riwayat['jumlah_alat'];

        try {
            $riwayat->update(['status' => "sudah kembali"]);

            // Update jumlah dan status ketersediaan alat
            $alat->update([
                'jumlah' => $jumlahalat,
                'status_ketersediaan' => $jumlahalat === 0 ? 'tidak tersedia' : 'tersedia',
            ]);
        } catch (\Exception $e) {
            // Jangan menyimpan objek $e ke sesi
            return redirect()->back()->with('error', 'Terjadi kesalahan pada sistem. Silakan coba lagi.')->withInput();
        }

        return redirect()->route('riwayat')->with('success', 'Alat yang dipinjam telah dikembalikan.');
    }

}
