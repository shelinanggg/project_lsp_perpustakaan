<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peminjam extends Authenticatable
{
    use HasFactory;

    protected $table = 'peminjam';
    protected $primaryKey = 'id_peminjam';

    protected $fillable = [
        'nama_peminjam',
        'tgl_daftar',
        'user_peminjam',
        'pass_peminjam',
        'foto_peminjam',
        'status_peminjam'
    ];

    protected $hidden = [
        'pass_peminjam',
    ];

    public function getAuthPassword()
    {
        return $this->pass_peminjam;
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_peminjam', 'id_peminjam');
    }
}