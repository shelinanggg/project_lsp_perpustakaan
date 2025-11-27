@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<h2>Kelola Buku</h2>

<p><a href="{{ route('admin.buku.create') }}">Tambah Buku Baru</a></p>

@if($buku->count() > 0)
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $b)
            <tr>
                <td>{{ $b->id_buku }}</td>
                <td>{{ $b->judul_buku }}</td>
                <td>{{ $b->nama_pengarang }}</td>
                <td>{{ $b->nama_penerbit }}</td>
                <td>{{ date('d-m-Y', strtotime($b->tgl_terbit)) }}</td>
                <td>
                    <a href="{{ route('admin.buku.edit', $b->id_buku) }}">Edit</a>
                    <form action="{{ route('admin.buku.destroy', $b->id_buku) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus buku ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Belum ada data buku.</p>
@endif

@endsection