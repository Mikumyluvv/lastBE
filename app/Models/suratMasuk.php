<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori_surat',
        'nik',
        'nama',
        'approved'
    ];
}
