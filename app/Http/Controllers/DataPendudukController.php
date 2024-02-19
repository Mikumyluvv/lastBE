<?php

namespace App\Http\Controllers;
use App\Models\dataPenduduk;
use Illuminate\Http\Request;
use App\Http\Requests\dataPendudukReq;

class DataPendudukController extends Controller
{
    public function index(){
        // return dataPenduduk::all();
        $data = dataPenduduk::paginate(10);
        $responseData =$data;
     return response()->json(['message' => 'All Data', 'data' => $responseData], 201);
    }

    public function getByNik($nik)
{
    $data = dataPenduduk::where('nik', $nik)->first();

    if ($data) {
        return response()->json(['message' => 'Data by NIK', 'data' => $data], 200);
    } else {
        return response()->json(['message' => 'Data not found'], 404);
    }
}


    public function addData(dataPendudukReq $request){

        // $request -> validate([
        //     // // Umumm
        //     // 'nik' => 'required|min:16',
        //     // 'nama_lengkap' => 'required',
        //     // 'jenis_kelamin' => 'required',
        //     // 'agama' => 'required',
        //     // 'pendidikan_terakhir' => 'required',
        //     // 'pekerjaan' => 'required',
        //     // 'rt' => 'required',
        //     // 'dusun' => 'required',
        //     // 'suku' => 'required',

        //     // // Kelahiran
        //     // 'tempat_lahir' => 'required',
        //     // 'tanggal_lahir' => 'required',
        //     // 'anak_ke' => 'required',
        //     // 'nomor_kk' => 'required',
        //     // 'kedudukan_dalam_keluarga' => 'required',

        //     // //nikah/cerai
        //     // 'status_perkawinan' => 'required',

        // ]);

        $penduduk = dataPenduduk::create($request->all());
        $id = $penduduk->id;
        $responseData = $penduduk->toArray();
        unset($responseData['id']);

        return response()->json(['message' => 'Data Penduduk berhasil ditambahkan', 'data' => ['id' => $id] + $responseData], 201);
    }

    public function search($query){
        try {
            $data = dataPenduduk::where('id', $query)->orWhere('nama_lengkap', 'LIKE', '%' . $query . '%')->get();
            if ($data) {
                return response()->json($data, 200);
            } else {
                return response()->json(['message' => 'Data Penduduk tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $query){
        $data = dataPenduduk::where('id', $query)->orWhere('nik', 'LIKE', '%' . $query . '%')->first();
        $data->update($request->all());
        return $data;
    }

    public function delete($id){
        try {
            $penduduk = DataPenduduk::find($id);
            if ($penduduk) {
                $penduduk->delete();
                return response()->json(['message' => 'Data Penduduk berhasil dihapus'], 200);
            } else {
                return response()->json(['message' => 'Data Penduduk tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }







}







// public function show($id){
    //     return dataPenduduk::find($id);
    // }

    // public function getById($id){
    //     try {
    //         $data = dataPenduduk::find($id);
    //         if ($data) {
    //             return response()->json($data, 200);
    //         } else {
    //             return response()->json(['message' => 'Data Penduduk tidak ditemukan'], 404);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    //     }
    // }

    // public function getByName($nama_lengkap){
    //     try {
    //         $data = dataPenduduk::where('nama_lengkap', $nama_lengkap)->first();

    //         if ($data) {
    //             return response()->json($data, 200);
    //         } else {
    //             return response()->json(['message' => 'Data Penduduk tidak ditemukan'], 404);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    //     }
    // }
