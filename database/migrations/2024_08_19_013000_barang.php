<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->string('foto');
        });

        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->text('trans_code');
            $table->integer('barang_id');
            $table->integer('qty');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
        Schema::dropIfExists('transaction');
    }
};
