<?php

namespace App\Imports;

use App\Models\dataPenduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class watu implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new dataPenduduk([

        //     'nik' => $row['nik'],
        //     'nama_lengkap' => $row['nama_lengkap'],
        //     'alamat_rumah' => $row['alamat_rumah'],
        // ]);


        try {
            return new dataPenduduk([
                'nik' => $row['nik'],
                'nama_lengkap' => $row['nama_lengkap'],
                'alamat_rumah' => $row['alamat_rumah'],
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan di sini
            // Misalnya, log pesan kesalahan atau kembalikan nilai default
            return null;
        }

          // Pastikan kunci yang diharapkan ada dalam array sebelum mencoba mengaksesnya
    // if (isset($row['nik']) && isset($row['nama_lengkap']) && isset($row['alamat_rumah'])) {
    //     return new dataPenduduk([
    //         'nik' => $row['nik'],
    //         'nama_lengkap' => $row['nama_lengkap'],
    //         'alamat_rumah' => $row['alamat_rumah'],
    //     ]);
    // } else {
    //     // Handle kesalahan jika kunci tidak ada
    //     // Contoh: throw new \Exception("Kunci tidak ditemukan dalam array");
    //     return null; // Atau lakukan sesuai dengan logika bisnis Anda
    // }
    }
}
