<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
    <div class="store-title">
        Tambah Barang
    </div>

    <div class="navbar">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/barang') }}">Daftar Barang</a>
        <a href="{{ url('/barang/tambah') }}">Tambah Barang</a>
        <a href="{{ url('/logout') }}">Keluar</a>
    </div>
    
    <div class="container">
        <h2 class="page-title">Tambah Barang</h2>
        <form action="{{url('barang/tambah/proses')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan</button>
        </form>
    </div>
</body>
</html>