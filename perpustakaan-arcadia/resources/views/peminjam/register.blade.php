@extends('layouts.app')

@section('title', 'Registrasi Peminjam')

@section('content')
<h2>Registrasi Peminjam</h2>

<form action="{{ route('peminjam.register.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required>
    </div>
    
    <div>
        <label>Username:</label><br>
        <input type="text" name="user_peminjam" value="{{ old('user_peminjam') }}" required>
    </div>
    
    <div>
        <label>Password:</label><br>
        <input type="password" name="pass_peminjam" required>
    </div>
    
    <div>
        <label>Foto (opsional):</label><br>
        <input type="file" name="foto_peminjam" accept="image/*">
    </div>
    
    <br>
    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="{{ route('peminjam.login') }}">Login di sini</a></p>
@endsection