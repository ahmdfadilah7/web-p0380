<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_invoice',
        'pelanggan_id',
        'jasakirim_id',
        'rekening_id',
        'ongkos_kirim',
        'total_invoice',
        'status',
        'konfirmasi',
    ];
}
