<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        // Validasi input email dan password
        $useradmin = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil user pertama dari database
        $admin = User::first();

        // Pastikan ada data user pertama di database
        if (!$admin) {
            return back()->with('error', 'User tidak ditemukan!')->withInput(['email' => null]);
        }

        // Check apakah email sesuai dengan user pertama
        if ($useradmin['email'] !== $admin->email) {
            return back()->with('error', 'Email tidak sesuai dengan user pertama!')->withInput(['email' => null]);
        }

        // Cek apakah password cocok menggunakan Hash::check
        if (!Hash::check($useradmin['password'], $admin->password)) {
            return back()->with('error', 'Password salah!')->withInput($request->only('email'));
        }

        // Login berhasil, regenerasi session
        Auth::login($admin); // Login user pertama secara manual
        $request->session()->regenerate();

        session()->flash('success', 'Admin berhasil login!');
        return redirect('/admin');
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

