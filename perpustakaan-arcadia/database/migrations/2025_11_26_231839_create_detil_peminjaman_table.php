<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detil_peminjaman', function (Blueprint $table) {
            $table->string('kode_pinjam', 20);
            $table->unsignedBigInteger('id_buku');
            $table->timestamps();

            $table->primary(['kode_pinjam', 'id_buku']);
            $table->foreign('kode_pinjam')->references('kode_pinjam')->on('peminjaman')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detil_peminjaman');
    }
};