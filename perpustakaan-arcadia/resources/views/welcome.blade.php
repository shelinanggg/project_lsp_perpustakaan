@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<h2>Selamat Datang di Sistem Drive-Thru Perpustakaan Arcadia</h2>

<p>Sistem peminjaman buku secara online dengan layanan drive-thru.</p>

<h3>Pilih Login:</h3>
<ul>
    <li><a href="{{ route('peminjam.login') }}">Login sebagai Peminjam</a></li>
    <li><a href="{{ route('admin.login') }}">Login sebagai Admin</a></li>
</ul>

<p>Belum punya akun peminjam? <a href="{{ route('peminjam.register') }}">Daftar di sini</a></p>

@endsection