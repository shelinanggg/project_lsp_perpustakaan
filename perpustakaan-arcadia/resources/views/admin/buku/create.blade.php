@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<h2>Tambah Buku Baru</h2>

<form action="{{ route('admin.buku.store') }}" method="POST">
    @csrf
    
    <div>
        <label>Judul Buku:</label><br>
        <input type="text" name="judul_buku" value="{{ old('judul_buku') }}" size="50" required>
    </div>
    
    <div>
        <label>Nama Pengarang:</label><br>
        <input type="text" name="nama_pengarang" value="{{ old('nama_pengarang') }}" required>
    </div>
    
    <div>
        <label>Nama Penerbit:</label><br>
        <input type="text" name="nama_penerbit" value="{{ old('nama_penerbit') }}" required>
    </div>
    
    <div>
        <label>Tanggal Terbit:</label><br>
        <input type="date" name="tgl_terbit" value="{{ old('tgl_terbit') }}" required>
    </div>
    
    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.buku.index') }}">Batal</a>
</form>

@endsection