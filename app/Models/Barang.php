<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'foto_barang',
        'harga_beli',
        'harga_barang',
        'diskon',
        'harga_diskon',
        'stok',
        'stok_minimum',
        'created_by',
        'updated_by'
    ];
}
