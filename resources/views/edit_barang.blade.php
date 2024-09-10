<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
</head>
<body>
    <div class="container">
        <h2>Edit {{$barang->nama_barang}}</h2>
        <form action="{{url('barang/edit/proses/')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="barang_id" value="{{$barang->barang_id}}">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{$barang->nama_barang}}">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" rows="10" class="form-control">{{$barang->deskripsi}}</textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{$barang->harga}}">
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{$barang->stok}}">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="form-control-file" value="{{$barang->foto}}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</body>
</html>