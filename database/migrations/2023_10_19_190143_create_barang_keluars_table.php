<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inv');
            $table->string('nama_petugas');
            $table->string('nama_pelanggan');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->integer('jumlah_keluar');
            $table->integer('harga_jual_satuan');
            $table->integer('diskon_persen')->default(0);
            $table->integer('diskon_rupiah')->default(0);
            $table->integer('harga_jual_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
