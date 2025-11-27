@extends('layouts.app')

@section('title', 'Pesan Buku')

@section('content')
<h2>Formulir Peminjaman Buku</h2>

<form action="{{ route('peminjam.store') }}" method="POST">
    @csrf
    
    <h3>Pilih Buku yang Ingin Dipinjam:</h3>
    
    @if($buku->count() > 0)
        @foreach($buku as $b)
            <div>
                <input type="checkbox" name="id_buku[]" value="{{ $b->id_buku }}" id="buku_{{ $b->id_buku }}">
                <label for="buku_{{ $b->id_buku }}">
                    <strong>{{ $b->judul_buku }}</strong> - 
                    {{ $b->nama_pengarang }} ({{ $b->nama_penerbit }}, {{ date('Y', strtotime($b->tgl_terbit)) }})
                </label>
            </div>
        @endforeach
    @else
        <p>Tidak ada buku tersedia.</p>
    @endif
    
    <br>
    <button type="submit">Pesan Buku</button>
    <a href="{{ route('peminjam.dashboard') }}">Batal</a>
</form>

@endsection