<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Buku;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk Admin
        Admin::create([
            'nama_admin' => 'Administrator',
            'user_admin' => 'admin',
            'pass_admin' => Hash::make('admin123')
        ]);

        // Seeder untuk Buku
        $bukuData = [
            [
                'judul_buku' => 'Laskar Pelangi',
                'tgl_terbit' => '2005-09-01',
                'nama_pengarang' => 'Andrea Hirata',
                'nama_penerbit' => 'Bentang Pustaka'
            ],
            [
                'judul_buku' => 'Bumi Manusia',
                'tgl_terbit' => '1980-08-01',
                'nama_pengarang' => 'Pramoedya Ananta Toer',
                'nama_penerbit' => 'Hasta Mitra'
            ],
            [
                'judul_buku' => 'Ronggeng Dukuh Paruk',
                'tgl_terbit' => '1982-01-01',
                'nama_pengarang' => 'Ahmad Tohari',
                'nama_penerbit' => 'Gramedia'
            ],
            [
                'judul_buku' => 'Negeri 5 Menara',
                'tgl_terbit' => '2009-01-01',
                'nama_pengarang' => 'Ahmad Fuadi',
                'nama_penerbit' => 'Gramedia'
            ],
            [
                'judul_buku' => 'Perahu Kertas',
                'tgl_terbit' => '2009-01-01',
                'nama_pengarang' => 'Dee Lestari',
                'nama_penerbit' => 'Bentang Pustaka'
            ],
            [
                'judul_buku' => 'Cantik Itu Luka',
                'tgl_terbit' => '2002-01-01',
                'nama_pengarang' => 'Eka Kurniawan',
                'nama_penerbit' => 'Gramedia'
            ],
            [
                'judul_buku' => 'Sang Pemimpi',
                'tgl_terbit' => '2006-01-01',
                'nama_pengarang' => 'Andrea Hirata',
                'nama_penerbit' => 'Bentang Pustaka'
            ],
            [
                'judul_buku' => 'Hujan',
                'tgl_terbit' => '2016-01-01',
                'nama_pengarang' => 'Tere Liye',
                'nama_penerbit' => 'Gramedia Pustaka Utama'
            ],
            [
                'judul_buku' => 'Pulang',
                'tgl_terbit' => '2015-01-01',
                'nama_pengarang' => 'Tere Liye',
                'nama_penerbit' => 'Republika'
            ],
            [
                'judul_buku' => 'Madre',
                'tgl_terbit' => '2011-01-01',
                'nama_pengarang' => 'Dee Lestari',
                'nama_penerbit' => 'Bentang Pustaka'
            ]
        ];

        foreach ($bukuData as $buku) {
            Buku::create($buku);
        }
    }
}