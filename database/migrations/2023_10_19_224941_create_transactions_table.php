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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inv');
            $table->string('nama_petugas');
            $table->string('nama_pelanggan');
            $table->string('status');
            $table->date('jatuh_tempo')->nullable();
            $table->string('keterangan');
            $table->integer('total')->default(0);
            $table->integer('bayar')->default(0);
            $table->integer('kembalian')->default(0);
            $table->integer('profit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
