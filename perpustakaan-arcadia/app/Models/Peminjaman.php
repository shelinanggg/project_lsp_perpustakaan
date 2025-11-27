<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'kode_pinjam';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pinjam',
        'id_admin',
        'id_peminjam',
        'tgl_pesan',
        'tgl_ambil',
        'tgl_wajibkembali',
        'tgl_kembali',
        'status_pinjam'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id_peminjam');
    }

    public function detilPeminjaman()
    {
        return $this->hasMany(DetilPeminjaman::class, 'kode_pinjam', 'kode_pinjam');
    }
}