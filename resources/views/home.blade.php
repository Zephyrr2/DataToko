<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataToko - Beranda</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
    <div class="store-title">
        Toko
    </div>
    <div class="navbar">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/barang') }}">Daftar Barang</a>
        <a href="{{ url('/barang/tambah') }}">Tambah Barang</a>
        <a href="{{ url('/logout') }}">Keluar</a>
    </div>

    <div class="container">
        <h1>Selamat Datang di DataToko</h1>
        <p>Silakan pilih menu di atas untuk mengelola data barang.</p>
    </div>
</body>
</html>
