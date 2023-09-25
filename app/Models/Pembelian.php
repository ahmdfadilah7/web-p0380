<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pembelian',
        'supplier_id',
        'barang_id',
        'jumlah',
        'harga',
        'ongkos_kirim',
        'total',
        'created_by',
        'updated_by',
    ];
}
