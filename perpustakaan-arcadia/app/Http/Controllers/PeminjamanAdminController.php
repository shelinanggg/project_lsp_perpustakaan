<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetilPeminjaman;
use Illuminate\Http\Request;

class PeminjamanAdminController extends Controller
{
    public function dashboard()
    {
        $peminjaman = Peminjaman::with(['peminjam', 'detilPeminjaman.buku'])
            ->orderBy('tgl_pesan', 'desc')
            ->get();
        
        return view('admin.dashboard', compact('peminjaman'));
    }

    public function show($kode_pinjam)
    {
        $peminjaman = Peminjaman::with(['peminjam', 'detilPeminjaman.buku', 'admin'])
            ->where('kode_pinjam', $kode_pinjam)
            ->firstOrFail();
        
        return view('admin.detail_peminjaman', compact('peminjaman'));
    }

    public function approve($kode_pinjam)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $kode_pinjam)
            ->where('status_pinjam', 'diproses')
            ->firstOrFail();
        
        $tgl_ambil = date('Y-m-d');
        $tgl_wajib_kembali = date('Y-m-d', strtotime('+7 days'));
        
        $peminjaman->update([
            'id_admin' => session('admin_id'),
            'tgl_ambil' => $tgl_ambil,
            'tgl_wajibkembali' => $tgl_wajib_kembali,
            'status_pinjam' => 'disetujui'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Peminjaman berhasil disetujui!');
    }

    public function reject($kode_pinjam)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $kode_pinjam)
            ->where('status_pinjam', 'diproses')
            ->firstOrFail();
        
        $peminjaman->update([
            'id_admin' => session('admin_id'),
            'status_pinjam' => 'ditolak'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Peminjaman berhasil ditolak!');
    }

    public function complete($kode_pinjam)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $kode_pinjam)
            ->where('status_pinjam', 'disetujui')
            ->firstOrFail();
        
        $peminjaman->update([
            'tgl_kembali' => date('Y-m-d'),
            'status_pinjam' => 'selesai'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Peminjaman berhasil diselesaikan!');
    }

    public function destroy($kode_pinjam)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $kode_pinjam)->firstOrFail();
        $peminjaman->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}