<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Toko</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
    <div class="store-title">
        Daftar Barang
    </div>

    <div class="navbar">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/barang') }}">Daftar Barang</a>
        <a href="{{ url('/barang/tambah') }}">Tambah Barang</a>
        <a href="{{ url('/logout') }}">Keluar</a>
    </div>
    
    @forelse ($barang as $brg)
    <div class="col-md-4">
        <div class="card">
            <img src="{{asset('image/' . $brg->foto)}}" class="card-img-top" alt="{{$brg->nama_barang}}">
            <div class="card-body">
                <h5 class="card-tittle">{{$brg->nama_barang}}</h5>
                <p class="card-text">{{$brg->deskripsi}}</p>
                <p class="card-text">{{$brg->harga}}</p>
                <div class="button-container">
                    <a href="#" class="btn btn-primary">Detail</a>
                    <a href="{{url('barang/edit/' . $brg->barang_id)}}" class="btn btn-success">Edit</a>
                    <form action="{{url('barang/delete')}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="barang_id" value="{{$brg->barang_id}}">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <form action="{{url('cart/process')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id_barang" value="{{$brg->barang_id}}">
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="btn btn-success">Tambah Ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @empty
    <div class="col-md-12 text-center">
        <p>Barang tidak ditemukan</p>
    </div>
    @endforelse
</body>
</html>