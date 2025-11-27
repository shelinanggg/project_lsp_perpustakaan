<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('kode_pinjam', 20)->primary();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_peminjam');
            $table->date('tgl_pesan');
            $table->date('tgl_ambil')->nullable();
            $table->date('tgl_wajibkembali')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->enum('status_pinjam', ['diproses', 'disetujui', 'ditolak', 'selesai'])->default('diproses');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('set null');
            $table->foreign('id_peminjam')->references('id_peminjam')->on('peminjam')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};