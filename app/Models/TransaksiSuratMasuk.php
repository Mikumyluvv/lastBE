<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'kode_surat',
        'deskripsi_pengajuan',
        'nik',
        'nama_lengkap',
        'file',
        'status',

    ];
    protected $casts = [
        'file' => 'array',
    ];
}
