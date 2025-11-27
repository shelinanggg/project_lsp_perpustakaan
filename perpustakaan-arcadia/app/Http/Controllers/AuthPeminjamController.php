<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthPeminjamController extends Controller
{
    public function showRegister()
    {
        return view('peminjam.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'user_peminjam' => 'required|string|max:50|unique:peminjam,user_peminjam',
            'pass_peminjam' => 'required|string|min:6',
            'foto_peminjam' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['tgl_daftar'] = date('Y-m-d');
        $data['pass_peminjam'] = Hash::make($request->pass_peminjam);
        $data['status_peminjam'] = 'aktif';

        if ($request->hasFile('foto_peminjam')) {
            $file = $request->file('foto_peminjam');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/peminjam'), $filename);
            $data['foto_peminjam'] = $filename;
        }

        Peminjam::create($data);

        return redirect()->route('peminjam.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('peminjam.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_peminjam' => 'required',
            'pass_peminjam' => 'required'
        ]);

        $peminjam = Peminjam::where('user_peminjam', $request->user_peminjam)->first();

        if ($peminjam && Hash::check($request->pass_peminjam, $peminjam->pass_peminjam)) {
            if ($peminjam->status_peminjam != 'aktif') {
                return back()->with('error', 'Akun Anda tidak aktif!');
            }
            
            session(['peminjam_id' => $peminjam->id_peminjam]);
            session(['peminjam_name' => $peminjam->nama_peminjam]);
            
            return redirect()->route('peminjam.dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget(['peminjam_id', 'peminjam_name']);
        return redirect()->route('peminjam.login');
    }
}