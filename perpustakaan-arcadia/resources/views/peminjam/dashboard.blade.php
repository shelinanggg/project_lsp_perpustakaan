@extends('layouts.app')

@section('title', 'Dashboard Peminjam')

@section('content')
<h2>Dashboard Peminjam</h2>

<p><a href="{{ route('peminjam.create') }}">Buat Peminjaman Baru</a></p>

<h3>Riwayat Peminjaman</h3>

@if($peminjaman->count() > 0)
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode Pinjam</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Ambil</th>
                <th>Tanggal Wajib Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->kode_pinjam }}</td>
                <td>{{ $p->tgl_pesan }}</td>
                <td>{{ $p->tgl_ambil ?? '-' }}</td>
                <td>{{ $p->tgl_wajibkembali ?? '-' }}</td>
                <td>{{ $p->tgl_kembali ?? '-' }}</td>
                <td>{{ strtoupper($p->status_pinjam) }}</td>
                <td>{{ $p->detilPeminjaman->count() }} buku</td>
                <td>
                    <a href="{{ route('peminjam.show', $p->kode_pinjam) }}">Detail</a>
                    @if($p->status_pinjam == 'diproses')
                        <form action="{{ route('peminjam.destroy', $p->kode_pinjam) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin membatalkan?')">Batalkan</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Belum ada peminjaman.</p>
@endif

@endsection