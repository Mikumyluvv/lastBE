<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSangatBaru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'deskripsi_singkat',
        'deskripsi',
        'syarat',
        'file',
    ];
    protected $casts = [
        'file' => 'array',
    ];
}
