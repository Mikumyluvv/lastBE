<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class dataPenduduk extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'agama',
        'golongan_darah',
        'pendidikan_terakhir',
        'pekerjaan',
        'no_telepon',
        'alamat_rumah',
        'no_rumah',
        'rt',
        'rw',
        'kampung',
        'dusun',
        'dapat_membaca_huruf',
        'kewarganegaraan',
        'kebangsaan',
        'suku',
        'jenis_penambahan',
        'jenis_pengurangan',
        'tempat_dilahirkan',
        'tempat_lahir',
        'tanggal_lahir',
        'jam_lahir',
        'waktu_lahir',
        'anak_ke',
        'jenis_kelahiran',
        'penolong_kelahiran',
        'berat_bayi',
        'panjang_bayi',
        'akta_kelahiran',
        'nomor_akta_kelahiran',
        'tanggal_akta_kelahiran',
        'tempat_diterbitkan_ktp',
        'tanggal_diterbitkan_ktp',
        'nomor_kk',
        'kedudukan_dalam_keluarga',
        'nik_ibu_kandung',
        'nik_ayah_kandung',
        'nama_ibu_kandung',
        'nama_ayah_kandung',
        'tempat_kematian',
        'desa_atau_kelurahan',
        'kecamatan',
        'kabupaten_atau_kota',
        'provinsi',
        'tanggal_kematian',
        'jam_kematian',
        'waktu_kematian',
        'umur_saat_meninggal',
        'sebab_kematian',
        'yang_mengabarkan_kematian',
        'akta_kematian',
        'nomor_akta_kematian',
        'tanggal_akta_kematian',
        'status_perkawinan',
        'akta_perkawinan',
        'nomor_akta_perkawinan',
        'tanggal_perkawinan',
        'lokasi_perkawinan',
        'akta_perceraian',
        'nomor_akta_perceraian',
        'tanggal_perceraian',
        'lokasi_perceraian',
        'kelainan_fisik',
        'penyandang_cacat',
        'pendapatan_perbulan',
        'keterangan'

    ];
}
