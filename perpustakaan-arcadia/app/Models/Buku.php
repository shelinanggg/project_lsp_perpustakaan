<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul_buku',
        'tgl_terbit',
        'nama_pengarang',
        'nama_penerbit'
    ];

    public function detilPeminjaman()
    {
        return $this->hasMany(DetilPeminjaman::class, 'id_buku', 'id_buku');
    }
}