<?php

namespace App\Http\Controllers;

use  App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    function login(Request $request){
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $user = Admin::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put('admin', true);
            $request->session()->put('id_admin', $user->id_admin);
            return redirect('barang');
        } else {
            echo "Email atau password salah, Silahkan diulang kembali.";
        }
    }

    public function register(){
        return view('register');
    }

    function reg(Request $request){
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));
        $nama_admin = htmlspecialchars($request->input('nama_admin'));

        $HashedPass = Hash::make($password);

        $admin = new Admin();

        $admin->email = $email;
        $admin->password = $HashedPass;
        $admin->nama_admin = $nama_admin;
        $admin->save();

        return redirect('login');
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        $request->session()->forget('id_admin');
        
        return redirect('login');
    }
}
