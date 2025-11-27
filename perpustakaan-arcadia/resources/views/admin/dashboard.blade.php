@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2>Dashboard Admin - Kelola Peminjaman</h2>

<h3>Daftar Peminjaman</h3>

@if($peminjaman->count() > 0)
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Ambil</th>
                <th>Tanggal Wajib Kembali</th>
                <th>Status</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->kode_pinjam }}</td>
                <td>{{ $p->peminjam->nama_peminjam }}</td>
                <td>{{ $p->tgl_pesan }}</td>
                <td>{{ $p->tgl_ambil ?? '-' }}</td>
                <td>{{ $p->tgl_wajibkembali ?? '-' }}</td>
                <td><strong>{{ strtoupper($p->status_pinjam) }}</strong></td>
                <td>{{ $p->detilPeminjaman->count() }} buku</td>
                <td>
                    <a href="{{ route('admin.peminjaman.show', $p->kode_pinjam) }}">Detail</a>
                    
                    @if($p->status_pinjam == 'diproses')
                        <form action="{{ route('admin.peminjaman.approve', $p->kode_pinjam) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Setujui</button>
                        </form>
                        <form action="{{ route('admin.peminjaman.reject', $p->kode_pinjam) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin tolak peminjaman ini?')">Tolak</button>
                        </form>
                    @endif
                    
                    @if($p->status_pinjam == 'disetujui')
                        <form action="{{ route('admin.peminjaman.complete', $p->kode_pinjam) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.peminjaman.destroy', $p->kode_pinjam) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Tidak ada data peminjaman.</p>
@endif

@endsection