<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

    public function beranda()
    {
        return view('home');
    }

    public function tampilBarang(){
        $barang = Barang::all();

        $sesi = session('admin');
        $adm = session('id_admin');

        $admin = Admin::where('id_admin', $adm)->first();

        if ($sesi === true) {
            return view('index', compact('barang'));
        }else{
            return view('login');
        }
    }

    function prosesTambahBarang(Request $request){
        $nama_barang = $request->input('nama_barang');
        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $foto = $request->file('foto');

        $barang = new Barang();

        $barang->nama_barang = $nama_barang;
        $barang->deskripsi = $deskripsi;
        $barang->harga = $harga;
        $barang->stok = $stok;
        $barang->foto = $foto;
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('image/', $request->file('foto')->getClientOriginalName());
            $barang->foto = $request->file('foto')->getClientOriginalName();
        }
        $barang->save();

        if($barang){
            return redirect('barang')->with('success', 'Data berhasil ditambahkan');
        }else{
            return redirect('barang')->with('eror', 'Data gagal ditambahkan');
        }
    }

    function editBarangProcess(Request $request){
        $barang_id = $request->input('barang_id');
        $nama_barang = $request->input('nama_barang');
        $deskripsi = $request->input('deskripsi');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $foto = $request->file('foto');

        $path = public_path() . '/image/';

        $query = Barang::where('barang_id', $barang_id)->first();

        $foto_lama = $query->foto;

        if ($foto) {
            $thumb = $foto->getClientOriginalName();
            File::delete($path . '/' . $foto_lama);
            $foto->move($path, $thumb);
        }

        $query->nama_barang = $nama_barang;
        $query->deskripsi = $deskripsi;
        $query->harga = $harga;
        $query->stok = $stok;
        $query->foto = $foto = $thumb;
        $query->save();

        if($query){
            return redirect('barang');
        }else{
            echo "Barang tidak dapat diubah";
            return redirect('barang');
        }
    }

    function hapusBarang(Request $request){
        $barang_id = $request->input('barang_id');
        $brg = Barang::where('barang_id', $barang_id)->first();

        $path = public_path() . '/image/';

        $foto_barang = $brg->foto;

        if ($brg) {
            $brg->delete();
            File::delete($path . '/' . $foto_barang);
            return redirect('barang');
        }else{
            echo "Barang tidak ada!!!";
            return redirect('barang');
        }
    }

    public function editBarang($barang_id){
        $barang = Barang::where('barang_id', $barang_id)->first();
        return view('edit_barang', compact('barang'));
    }

    public function tambahBarang(){
        return view('tambahBarang');
    }

    public function Cart(){
        $cart = Cart::join('barang', 'barang.barang_id', '=', 'cart.id_barang')->get();
        return view('keranjang', compact('cart'));
    }

    function addToCart(Request $request){
        $id_barang = $request->input('id_barang');
        $jumlah = $request->input('jumlah');

        $cartCheck = Cart::where('id_barang', $id_barang)->first();

        if ($cartCheck) {
            $cartCheck->jumlah = $cartCheck->jumlah + $jumlah;
            $cartCheck->save();
        }else{
            $cart = new Cart();
            $cart->id_barang = $id_barang;
            $cart->jumlah = $jumlah;
            $cart->save();
        }

        return redirect('cart');
    }

    public function updateCart(Request $request)
    {
        $id_cart = $request->input('id_cart');
        $qty = $request->input('qty');

        $cart = Cart::where('id_cart',$id_cart)->first();

        if ($cart) {
            $cart->qty = $qty;
            $cart->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart not found.']);
        }
    }

    public function checkoutProcess(){
        $cart = Cart::join('barang', 'barang.barang_id', '=', 'cart.id_barang')->select('cart.id_barang', 'barang.harga', 'barang.nama_barang', 'cart.qty')->get();

        $trans_code = "TRX-" . mt_rand(100000, 999999);
        $subtotal = 0;
        $total = 0;

        foreach ($cart as $keranjang) {
            $transaction = new Transaction();
            $transaction->trans_code = $trans_code;
            $transaction->id_barang = $keranjang->id_barang;
            $transaction->qty = $keranjang->qty;
            $subtotal = $keranjang->harga * $keranjang->qty;
            $total = $total =+ $subtotal;
            $transaction->total = $total;
            $transaction->save();
        }

        Cart::truncate();

        return redirect('order/confirm');
    }

    public function orderConfirm(){
        $trans = Transaction::select('trans_code','nama_barang','qty','harga')
        ->join('barang','barang.barang_id','=','transaction.barang_id')
        ->orderBy('transaction.created_at')
        ->get();
        return view('confirmOrder', compact('trans'));
    }
}