<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjam', function (Blueprint $table) {
            $table->id('id_peminjam');
            $table->string('nama_peminjam', 100);
            $table->date('tgl_daftar');
            $table->string('user_peminjam', 50)->unique();
            $table->string('pass_peminjam');
            $table->string('foto_peminjam')->nullable();
            $table->enum('status_peminjam', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjam');
    }
};