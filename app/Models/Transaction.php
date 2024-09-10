<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $tabel = 'transactions';
    protected $primaryKey = 'id_transaction';
    protected $fillabel = ['trans_code', 'barang_id', 'qty', 'total'];
}
