@extends('layouts.app')

@section('title', 'Login Peminjam')

@section('content')
<h2>Login Peminjam</h2>

<form action="{{ route('peminjam.login.submit') }}" method="POST">
    @csrf
    
    <div>
        <label>Username:</label><br>
        <input type="text" name="user_peminjam" required>
    </div>
    
    <div>
        <label>Password:</label><br>
        <input type="password" name="pass_peminjam" required>
    </div>
    
    <br>
    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="{{ route('peminjam.register') }}">Daftar di sini</a></p>
<p><a href="/">Kembali ke Beranda</a></p>
@endsection