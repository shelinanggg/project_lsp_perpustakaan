@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h2>Detail Peminjaman</h2>

<table>
    <tr>
        <td>Kode Pinjam</td>
        <td>: {{ $peminjaman->kode_pinjam }}</td>
    </tr>
    <tr>
        <td>Tanggal Pesan</td>
        <td>: {{ $peminjaman->tgl_pesan }}</td>
    </tr>
    <tr>
        <td>Tanggal Ambil</td>
        <td>: {{ $peminjaman->tgl_ambil ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tanggal Wajib Kembali</td>
        <td>: {{ $peminjaman->tgl_wajibkembali ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tanggal Kembali</td>
        <td>: {{ $peminjaman->tgl_kembali ?? '-' }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>: <strong>{{ strtoupper($peminjaman->status_pinjam) }}</strong></td>
    </tr>
    <tr>
        <td>Diproses oleh Admin</td>
        <td>: {{ $peminjaman->admin->nama_admin ?? '-' }}</td>
    </tr>
</table>

<h3>Daftar Buku yang Dipinjam:</h3>
<ol>
    @foreach($peminjaman->detilPeminjaman as $detil)
        <li>
            <strong>{{ $detil->buku->judul_buku }}</strong><br>
            Pengarang: {{ $detil->buku->nama_pengarang }}<br>
            Penerbit: {{ $detil->buku->nama_penerbit }}
        </li>
    @endforeach
</ol>

<p><a href="{{ route('peminjam.dashboard') }}">Kembali ke Dashboard</a></p>

@endsection