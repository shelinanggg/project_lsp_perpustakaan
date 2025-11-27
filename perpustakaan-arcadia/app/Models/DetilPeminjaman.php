<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detil_peminjaman';
    public $incrementing = false;
    protected $primaryKey = ['kode_pinjam', 'id_buku'];

    protected $fillable = [
        'kode_pinjam',
        'id_buku'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'kode_pinjam', 'kode_pinjam');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}