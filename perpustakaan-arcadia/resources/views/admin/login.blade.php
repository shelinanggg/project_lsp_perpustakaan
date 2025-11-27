@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<h2>Login Admin</h2>

<form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
    
    <div>
        <label>Username:</label><br>
        <input type="text" name="user_admin" required>
    </div>
    
    <div>
        <label>Password:</label><br>
        <input type="password" name="pass_admin" required>
    </div>
    
    <br>
    <button type="submit">Login</button>
</form>

<p><a href="/">Kembali ke Beranda</a></p>
@endsection