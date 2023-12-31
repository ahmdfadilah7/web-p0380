<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'subjek_pengirim',
        'pesan',
    ];
}
