<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetilPeminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanPeminjamController extends Controller
{
    public function dashboard()
    {
        $peminjam_id = session('peminjam_id');
        $peminjaman = Peminjaman::where('id_peminjam', $peminjam_id)
            ->with(['detilPeminjaman.buku'])
            ->orderBy('tgl_pesan', 'desc')
            ->get();
        
        return view('peminjam.dashboard', compact('peminjaman'));
    }

    public function create()
    {
        $buku = Buku::all();
        return view('peminjam.create_peminjaman', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|array|min:1',
            'id_buku.*' => 'exists:buku,id_buku'
        ]);

        $kode_pinjam = 'PJM' . date('Ymd') . rand(1000, 9999);
        
        $peminjaman = Peminjaman::create([
            'kode_pinjam' => $kode_pinjam,
            'id_peminjam' => session('peminjam_id'),
            'tgl_pesan' => date('Y-m-d'),
            'status_pinjam' => 'diproses'
        ]);

        foreach ($request->id_buku as $id_buku) {
            DetilPeminjaman::create([
                'kode_pinjam' => $kode_pinjam,
                'id_buku' => $id_buku
            ]);
        }

        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil dipesan!');
    }

    public function show($kode_pinjam)
    {
        $peminjaman = Peminjaman::with(['detilPeminjaman.buku', 'admin'])
            ->where('kode_pinjam', $kode_pinjam)
            ->where('id_peminjam', session('peminjam_id'))
            ->firstOrFail();
        
        return view('peminjam.detail_peminjaman', compact('peminjaman'));
    }

    public function destroy($kode_pinjam)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $kode_pinjam)
            ->where('id_peminjam', session('peminjam_id'))
            ->where('status_pinjam', 'diproses')
            ->firstOrFail();
        
        $peminjaman->delete();

        return redirect()->route('peminjam.dashboard')->with('success', 'Peminjaman berhasil dibatalkan!');
    }
}