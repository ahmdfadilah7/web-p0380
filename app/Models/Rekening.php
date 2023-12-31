<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'nama_rekening',
        'no_rekening',
        'created_by',
        'updated_by'
    ];
}
