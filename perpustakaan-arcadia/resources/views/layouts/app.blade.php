<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Perpustakaan Arcadia</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Perpustakaan Arcadia - Drive Thru</h1>
        @if(session('admin_id'))
            <p>Selamat datang, {{ session('admin_name') }} (Admin)</p>
            <nav>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
                <a href="{{ route('admin.buku.index') }}">Kelola Buku</a> |
                <a href="{{ route('admin.logout') }}">Logout</a>
            </nav>
        @elseif(session('peminjam_id'))
            <p>Selamat datang, {{ session('peminjam_name') }}</p>
            <nav>
                <a href="{{ route('peminjam.dashboard') }}">Dashboard</a> |
                <a href="{{ route('peminjam.create') }}">Pesan Buku</a> |
                <a href="{{ route('peminjam.logout') }}">Logout</a>
            </nav>
        @endif
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Perpustakaan Arcadia</p>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>