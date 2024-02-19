<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dataPendudukReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                                                // // Umumm
                                                // 'nik' => 'required|min:16',
                                                // 'nama_lengkap' => 'required',
                                                // 'jenis_kelamin' => 'required',
                                                // 'agama' => 'required',
                                                // 'pendidikan_terakhir' => 'required',
                                                // 'pekerjaan' => 'required',
                                                // 'rt' => 'required',
                                                // 'dusun' => 'required',
                                                // 'suku' => 'required',

                                                // // Kelahiran
                                                // 'tempat_lahir' => 'required',
                                                // 'tanggal_lahir' => 'required',
                                                // 'anak_ke' => 'required',
                                                // 'nomor_kk' => 'required',
                                                // 'kedudukan_dalam_keluarga' => 'required',

                                                // //nikah/cerai
                                                // 'status_perkawinan' => 'required',
        ];
    }
}
