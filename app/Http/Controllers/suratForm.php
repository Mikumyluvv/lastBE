<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\surat;
use App\Models\suratKematian;
use App\Models\jenisSurat;
use App\Models\suratMasuk;
use App\Models\UploadPDF;
use App\Models\SuratSangatBaru;
use App\Models\TransaksiSuratMasuk;
use App\Http\Requests\suratReq;
use App\Http\Requests\jenisSuratReq;
use App\Http\Requests\suratMasukReq;


use App\Models\dataPenduduk;

use App\Http\Requests\dataPendudukReq;

class suratForm extends Controller
{

    public function getData()
    {
        $data = surat::all();
        $response = $data;

        return response() -> json(['message' => 'all data', 'data' => $response ], 201);
    }

    public function addData(suratReq $request)
    {

        $data = surat::create($request -> all());
        $response = $data;

        return response() -> json(['message' => $response], 201);
    }

    public function addDataKematian($id)
    {
        $surat = surat::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $dataKematian = suratKematian::create([
            'nik' => $surat->nik,
            'nama' => $surat->nama,
            'keterangan' => $surat->keterangan,
        ]);
        $surat->delete();
        return response()->json(['message' => 'Data moved to suratKematian', 'data' => $dataKematian], 200);
    }

    public function addSurat(jenisSuratReq $request)
    {
        $data = jenisSurat::create($request -> all());
        $response = $data;

        return response() -> json(['message' => $response]);
    }

    public function addSuratMasuk(suratMasukReq $request)
    {
        $data = suratMasuk::create($request -> all());
        $response = $data;

        return response()->json(['message' => $response]);
    }


    public function approvedSurat($id)
    {
        $data = suratMasuk::find($id);

        if($data){
            $data->approved = true;
            $data->save();
        }

        return response()->json(['message' => $data]);
    }

    public function getSuratBelumApproved()
    {
        // Run the query using Eloquent
        $suratBelumApproved = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama','surat_masuks.created_at', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 0)
            ->get();
            $totalData = $suratBelumApproved->count();
        // Return the result as a JSON response
        return response()->json([
            'total' => $totalData,
            'data' => $suratBelumApproved,

        ]);
    }

    public function getSuratApprovedKematian()
    {

        $suratApprovedKematian = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 1)
            ->where('surat_masuks.id_kategori_surat', '=', 1)
            ->get();

        $totalData = $suratApprovedKematian->count();


        return response()->json([
            'data' => $suratApprovedKematian,
            'total' => $totalData,
        ]);
    }


    public function getSuratApprovedNikah()
    {

        $suratApprovedKematian = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 1)
            ->where('surat_masuks.id_kategori_surat', '=', 2)
            ->get();

        $totalData = $suratApprovedKematian->count();


        return response()->json([
            'data' => $suratApprovedKematian,
            'total' => $totalData,
        ]);
    }

    public function getSuratApprovedCerai()
    {

        $suratApprovedKematian = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 1)
            ->where('surat_masuks.id_kategori_surat', '=', 3)
            ->get();

        $totalData = $suratApprovedKematian->count();


        return response()->json([
            'data' => $suratApprovedKematian,
            'total' => $totalData,
        ]);
    }


    public function getSuratApprovedOtomatis($id_kategori_surat)
    {
        // Run the query using Eloquent
        $suratApproved = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 1)
            ->where('surat_masuks.id_kategori_surat', '=', $id_kategori_surat)
            ->get();

        // Get the total count
        $totalData = $suratApproved->count();

        // Return the result as a JSON response with the total count
        return response()->json([
            'data' => $suratApproved,
            'total' => $totalData,
            'message' => "Successfully retrieved surat approved data for kategori_surat = $id_kategori_surat with total count."
        ]);
    }


    public function getSuratApprovedByCategory($kategori_surat)
    {
        // Find the JenisSurat by name
        $jenisSurat = JenisSurat::where('kategori_surat', $kategori_surat)->first();

        if (!$jenisSurat) {
            return response()->json(['message' => 'Invalid kategori_surat'], 404);
        }

        $id_kategori_surat = $jenisSurat->id;

        // Run the query using Eloquent
        $suratApproved = SuratMasuk::select('surat_masuks.id', 'surat_masuks.nik', 'surat_masuks.nama', 'surat_masuks.approved', 'jenis_surats.kategori_surat')
            ->leftJoin('jenis_surats', 'surat_masuks.id_kategori_surat', '=', 'jenis_surats.id')
            ->where('surat_masuks.approved', '=', 1)
            ->where('surat_masuks.id_kategori_surat', '=', $id_kategori_surat)
            ->get();

        // Get the total count
        $totalData = $suratApproved->count();

        // Return the result as a JSON response with the total count
        return response()->json([
            'data' => $suratApproved,
            'total' => $totalData,
            'message' => "Successfully retrieved surat approved data for kategori_surat = $kategori_surat with total count."
        ]);
    }

    // public function uploadPDF(Request $request)
    // {


    //     try {
    //         $file = $request->file('image');
    //         $name= time();
    //         $extension =$file->getClientOriginalExtension();
    //         $newname = $name . '-' . $extension;

    //         $path = Storage::putFileAs('public', $request->file('image'),$newname);

    //         $data = [
    //             'path' => $path
    //         ];

    //       return uploadPDF::create($data);


    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }


    // public function uploadPDF(Request $request)
    // {
    //     try {
    //         $file = $request->file('image');
    //         $name = time();
    //         $extension = $file->getClientOriginalExtension();
    //         $newname = $name . '-' . $extension;

    //         $path = Storage::putFileAs('public', $file, $newname);

    //         $data = [
    //             'path' => $path,
    //             'nik' => $request->input('nik'), // Retrieve the 'nik' value from the request
    //         ];

    //         return UploadPDF::create($data); // Use the model name with uppercase 'U'

    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }


    public function uploadPDF(Request $request)
{
    try {
        $nik = $request->input('nik');


        $existingPenduduk = dataPenduduk::where('nik', $nik)->first();

        if (!$existingPenduduk) {
            return response()->json(['message' => 'NIK not found'], 404);
        }


        $file = $request->file('image');
        // $name = time();
        $name = $nik;
        $extension = $file->getClientOriginalExtension();
        $newname = $name . '-' . $extension;

        Storage::putFileAs('public/haha', $file, $newname);

        $data = [
            'path' => 'storage/haha/' . $newname,
            'nik' => $nik,
        ];

        return UploadPDF::create($data);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

public function getPDF()
{
    try {
        $data = UploadPDF::all();

        return response()->json(['message' => 'All Data', 'data' => $data], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}





public function uploadNewFiles(Request $request)
{
    try {
        $uuid = (string) \Illuminate\Support\Str::uuid();

        $nama = $request->input('nama');
        $deskripsi_singkat = $request->input('deskripsi_singkat');
        $deskripsi = $request->input('deskripsi');
        $syarat = $request->input('syarat');

        $newData = new SuratSangatBaru;
        $newData->uuid = $uuid;
        $newData->nama = $nama;
        $newData->deskripsi_singkat = $deskripsi_singkat;
        $newData->deskripsi = $deskripsi;
        $newData->syarat = $syarat;

        if ($request->hasFile('file')) {
            $files = $request->file('file');

            $request->validate([
                'file.*' => 'required|mimes:pdf|max:2048',

            ]);

            $filePaths = [];

            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                Storage::putFileAs('public/haha', $file, $name);
                $filePaths[] = 'storage/haha/' . $name;
            }

            $newData->file = json_encode(['paths' => $filePaths]);
            $newData->save();

            $responseData = [
                'paths' => $filePaths,
            ];

            return response()->json(['message' => 'Files uploaded successfully', 'data' => $responseData], 200);
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}


// public function uploadNewFiles(Request $request)
// {
//     try {
//         $uuid = (string) \Illuminate\Support\Str::uuid();

//         $nama = $request->input('nama');
//         $deskripsi_singkat = $request->input('deskripsi_singkat');
//         $deskripsi = $request->input('deskripsi');
//         $syarat = $request->input('syarat');

//         $newData = new SuratSangatBaru;
//         $newData->uuid = $uuid;
//         $newData->nama = $nama;
//         $newData->deskripsi_singkat = $deskripsi_singkat;
//         $newData->deskripsi = $deskripsi;
//         $newData->syarat = $syarat;

//         if ($request->hasFile('file')) {
//             $files = $request->file('file');

//             $request->validate([
//                 'file.*' => 'required|mimes:pdf|max:2048',
//             ]);

//             $filePaths = [];

//             foreach ($files as $file) {
//                 $name = time() . '-' . $file->getClientOriginalName();
//                 Storage::putFileAs('public/haha', $file, $name);
//                 $filePaths[] = 'storage/haha/' . $name;
//             }

//             // Menggunakan implode untuk menggabungkan paths menjadi satu string
//             $newData->file = implode(',', $filePaths);
//             $newData->save();

//             $responseData = [
//                 'paths' => $filePaths,
//             ];

//             return response()->json(['message' => 'Files uploaded successfully', 'data' => $responseData], 200);
//         } else {
//             return response()->json(['message' => 'No file uploaded'], 400);
//         }
//     } catch (\Exception $e) {
//         return response()->json(['message' => $e->getMessage()], 500);
//     }
// }


// public function getUploadedFiles(Request $request)
// {
//     try {
//         // You can add any conditions or filters here based on your requirements
//         $uploadedFiles = SuratSangatBaru::all();

//         return response()->json(['data' => $uploadedFiles], 200);
//     } catch (\Exception $e) {
//         return response()->json(['message' => $e->getMessage()], 500);
//     }
// }

public function getUploadedFiles(Request $request)
{
    try {
        // You can add any conditions or filters here based on your requirements
        $uploadedFiles = SuratSangatBaru::all();

        $formattedFiles = [];

        foreach ($uploadedFiles as $file) {
            $filePaths = json_decode($file->file, true)['paths'];

            $formattedFiles[] = [
                'uuid' => $file->uuid,
                'nama' => $file->nama,
                'deskripsi_singkat' => $file->deskripsi_singkat,
                'deskripsi' => $file->deskripsi,
                'syarat' => $file->syarat,
                'file_paths' => $filePaths,
            ];
        }

        return response()->json(['data' => $formattedFiles], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

public function getUploadedFilesByName(Request $request, $nama)
{
    try {
        // You can add any conditions or filters here based on your requirements
        $uploadedFiles = SuratSangatBaru::where('nama', $nama)->get();

        $formattedFiles = [];

        foreach ($uploadedFiles as $file) {
            $filePaths = json_decode($file->file, true)['paths'];

            $formattedFiles[] = [
                'uuid' => $file->uuid,
                'nama' => $file->nama,
                'deskripsi_singkat' => $file->deskripsi_singkat,
                'deskripsi' => $file->deskripsi,
                'syarat' => $file->syarat,
                'file_paths' => $filePaths,
            ];
        }

        return response()->json(['data' => $formattedFiles], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}




public function uploadFiles(Request $request)
    {
        try {
            $kode_transaksi = (string) \Illuminate\Support\Str::uuid();
            $kode_surat = $request->input('kode_surat');
            $deskripsi_pengajuan = $request->input('deskripsi_pengajuan');
            $nik = $request->input('nik');
            $nama_lengkap = $request->input('nama_lengkap');

            $newTransaction = new TransaksiSuratMasuk;
            $newTransaction->kode_transaksi = $kode_transaksi;
            $newTransaction->kode_surat = $kode_surat;
            $newTransaction->deskripsi_pengajuan = $deskripsi_pengajuan;
            $newTransaction->nik = $nik;
            $newTransaction->nama_lengkap = $nama_lengkap;

            if ($request->hasFile('file')) {
                $files = $request->file('file');

                $request->validate([
                    'file.*' => 'required|mimes:pdf|max:2048',
                ]);

                $filePaths = [];

                foreach ($files as $file) {
                    $name = time() . '-' . $file->getClientOriginalName();
                    Storage::putFileAs('public/uploads', $file, $name);
                    $filePaths[] = 'storage/uploads/' . $name;
                }

                $newTransaction->file = json_encode(['paths' => $filePaths]);
                $newTransaction->save();

                $responseData = [
                    'paths' => $filePaths,
                ];

                return response()->json(['message' => 'Files uploaded successfully', 'data' => $responseData], 200);
            } else {
                return response()->json(['message' => 'No file uploaded'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function gethaha()
    {
        try {
            $transactions = TransaksiSuratMasuk::all();

            $transactionDetails = [];

            foreach ($transactions as $transaction) {
                $jenisSurat = '';
                $suratSangatBaru = SuratSangatBaru::where('uuid', $transaction->kode_surat)->first();
                if ($suratSangatBaru) {
                    $jenisSurat = $suratSangatBaru->nama;
                }

                $transactionDetails[] = [
                    'kode_transaksi' => $transaction->kode_transaksi,
                    'deskripsi_pengajuan' => $transaction->deskripsi_pengajuan,
                    'nik' => $transaction->nik,
                    'nama_lengkap' => $transaction->nama_lengkap,
                    'file' => json_decode($transaction->file, true)['paths'], // Adjust this based on your actual file structure
                    'jenis_surat' => $jenisSurat,
                    'status' => $transaction->status,
                ];
            }

            return response()->json(['data' => $transactionDetails], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }






    // public function gethaha()
    // {
    //     try {
    //         $transactions = TransaksiSuratMasuk::all();

    //         $transactionDetails = [];

    //         foreach ($transactions as $transaction) {
    //             $jenisSurat = '';
    //             $suratSangatBaru = SuratSangatBaru::where('uuid', $transaction->kode_surat)->first();
    //             if ($suratSangatBaru) {
    //                 $jenisSurat = $suratSangatBaru->nama;
    //             }

    //             $filePaths = json_decode($transaction->file, true)['paths'];

    //             // Decode file paths here
    //             $decodedFilePaths = array_map(function ($filePath) {
    //                 return json_decode($filePath, true);
    //             }, $filePaths);

    //             $transactionDetails[] = [
    //                 'kode_transaksi' => $transaction->kode_transaksi,
    //                 'deskripsi_pengajuan' => $transaction->deskripsi_pengajuan,
    //                 'nik' => $transaction->nik,
    //                 'nama_lengkap' => $transaction->nama_lengkap,
    //                 'file' => $decodedFilePaths,
    //                 'jenis_surat' => $jenisSurat,
    //                 'status' => $transaction->status,
    //             ];
    //         }

    //         return response()->json(['data' => $transactionDetails], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 500);
    //     }
    // }




}
