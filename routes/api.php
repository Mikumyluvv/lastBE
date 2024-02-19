<?php

use App\Models\dataPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\importController;
use App\Http\Controllers\watuController;
use App\Http\Controllers\suratForm;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// ADD JENIS SURAT
Route::post('/addJenis', [suratForm::class, 'addSurat']);
// SURAT MASUK
Route::post('/suratMasuk', [suratForm::class, 'addSuratMasuk']);


// GET SURAT APPROVED
Route::post('/uppdf', [suratForm::class, 'uploadPDF']);
Route::get('/getpdf', [suratForm::class, 'getPDF']);

Route::post('/jajaja', [suratForm::class, 'uploadNewFiles']);
Route::get('/jajaja', [suratForm::class, 'getUploadedFiles']);
Route::get('/jajaja/{nama}', [suratForm::class, 'getUploadedFilesByName']);




Route::post('/zazaza', [suratForm::class, 'uploadFiles']);
Route::get('/gethaha', [suratForm::class, 'gethaha']);

Route::get('/getNikah', [suratForm::class, 'getSuratApprovedNikah']);
Route::get('/getCerai', [suratForm::class, 'getSuratApprovedCerai']);

Route::get('/getSuratApprovedOtomatis/{id_kategori_surat}', [suratForm::class, 'getSuratApprovedOtomatis']);

Route::get('/getSuratApproved/{kategori_surat}', [suratForm::class, 'getSuratApprovedByCategory']);



// FORM SURAT
Route::get('/getSurat', [suratForm::class, 'getData']);
Route::post('/addSurat', [suratForm::class, 'addData']);
// SURAT KEMATIAN
Route::post('/addSurat-Kematian/{id}', [suratForm::class, 'addDataKematian']);

// UMUM
Route::post('/regis', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/pdf', [UploadFileController::class, 'upload']);
Route::get('/file/{filename}', [UploadFileController::class, 'getFile']);

// IMPORT EXCEL
Route::post('/csv', [importController::class, 'import']);
Route::post('/watu', [watuController::class, 'import']);



Route::group(['middleware' => ['auth:sanctum']], function(){

    // POST
    Route::post('/tambah-penduduk', [DataPendudukController::class, 'addData']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // GET
    Route::get('/data-penduduk', [DataPendudukController::class, 'index']);
    Route::get('/data-penduduk/{nik}', [DataPendudukController::class, 'getByNik']);

    Route::get('/search/{query}', [DataPendudukController::class, 'search']);
    // PUT
    Route::put('/edit-penduduk/{query}', [DataPendudukController::class, 'update']);
    // DELETE
    Route::delete('/delete-penduduk/{id}', [DataPendudukController::class, 'delete']);

    // GET SURAT BELUM APPROVED
    Route::get('/getSuratBelumApproved', [suratForm::class, 'getSuratBelumApproved']);


    // APPROVED SURAT
Route::post('/approved/{id}', [suratForm::class, 'approvedSurat']);

Route::get('/getKematian', [suratForm::class, 'getSuratApprovedKematian']);

});





// Route::options('/approved/{id}', function () {
//     return response('', 200)
//         ->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
//         ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
// });



// Route::middleware('auth:sanctum')->get('/user', function () {

// });

// Route::post('/tambah-penduduk', function () {

//     // $data = request()->all();

//     $penduduk = DataPenduduk::create([
//         'nik' => '1234567890123456',
//         'nama_lengkap' => 'John Doe',
//         'jenis_kelamin' => 'Laki-Laki',
//         'agama' => 'Islam',
//         'golongan_darah' => 'O',
//         'pendidikan_terakhir' => 'S1',
//         'pekerjaan' => 'Programmer',
//         'no_telepon' => '1234567890',
//         'alamat_rumah' => 'Jl. Contoh No. 123',
//         'no_rumah' => '42',
//         'rt' => '1',
//         'rw' => '2',
//         'kampung' => 'Kampung Contoh',
//         'dusun' => 'Dusun Contoh',
//         'dapat_membaca_huruf' => 'Ya',
//         'kewarganegaraan' => 'WNI',
//         'kebangsaan' => 'Indonesia',
//         'suku' => 'Contoh',
//         'jenis_penambahan' => 'Contoh',
//         'jenis_pengurangan' => 'Contoh',
//         'tempat_dilahirkan' => 'Rumah Sakit',
//         'tempat_lahir' => 'Jakarta',
//         'tanggal_lahir' => '1990-01-01',
//         'jam_lahir' => '12:00:00',
//         'waktu_lahir' => 'Pagi',
//         'anak_ke' => '2',
//         'jenis_kelahiran' => 'Normal',
//         'penolong_kelahiran' => 'Bidan',
//         'berat_bayi' => '3000',
//         'panjang_bayi' => '50',
//         'akta_kelahiran' => 'Ya',
//         'nomor_akta_kelahiran' => '123',
//         'tanggal_akta_kelahiran' => '1990-01-01',
//         'tempat_diterbitkan_ktp' => 'Kantor Desa',
//         'tanggal_diterbitkan_ktp' => '1990-01-01',
//         'nomor_kk' => '987654321',
//         'kedudukan_dalam_keluarga' => 'Anak Kedua',
//         'nik_ibu_kandung' => '1234567890123456',
//         'nik_ayah_kandung' => '1234567890123456',
//         'nama_ibu_kandung' => 'Jane Doe',
//         'nama_ayah_kandung' => 'John Doe Sr.',
//         'tempat_kematian' => 'Rumah Sakit',
//         'desa_atau_kelurahan' => 'Desa Contoh',
//         'kecamatan' => 'Kecamatan Contoh',
//         'kabupaten_atau_kota' => 'Kota Contoh',
//         'provinsi' => 'Provinsi Contoh',
//         'tanggal_kematian' => '1990-01-01',
//         'jam_kematian' => '12:00:00',
//         'waktu_kematian' => 'Sore',
//         'umur_saat_meninggal' => '32',
//         'sebab_kematian' => 'Sakit',
//         'yang_mengabarkan_kematian' => 'Famili',
//         'akta_kematian' => 'Ya',
//         'nomor_akta_kematian' => '456',
//         'tanggal_akta_kematian' => '1990-01-01',
//     ]);

//     $responseData = $penduduk->toArray();
//     $id = $responseData['id'];
//     unset($responseData['id']);  // Hapus ID dari array
//     $responseData = ['id' => $id] + $responseData;
//     return response()->json(['message' => 'Data Penduduk berhasil ditambahkan', 'data' => $responseData], 201);
// });







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});












// Route::post('/tambah-penduduk', function () {
//         return dataPenduduk::create([
//             'nik' => '1234567890123456',
//         ]);
// });









// Route::post('/tambah-penduduk', function () {
//     // Mendapatkan data dari request
//     $data = request()->all();

//     // Membuat data penduduk baru
//     $penduduk = DataPenduduk::create([
//         'nik' => 1234567890123456,
//         'nama_lengkap' => 'John Doe',
//         'jenis_kelamin' => 'Laki-Laki',
//         'agama' => 'Islam',
//         'golongan_darah' => 'O',
//         'pendidikan_terakhir' => 'S1',
//         'pekerjaan' => 'Programmer',
//         'no_telepon' => 1234567890,
//         'alamat_rumah' => 'Jl. Contoh No. 123',
//         'no_rumah' => 42,
//         'rt' => 1,
//         'rw' => 2,
//         'kampung' => 'Kampung Contoh',
//         'dusun' => 'Dusun Contoh',
//         'dapat_membaca_huruf' => 'Ya',
//         'kewarganegaraan' => 'WNI',
//         'kebangsaan' => 'Indonesia',
//         'suku' => 'Contoh',
//         'jenis_penambahan' => 'Contoh',
//         'jenis_pengurangan' => 'Contoh',
//         'tempat_dilahirkan' => 'Rumah Sakit',
//         'tempat_lahir' => 'Jakarta',
//         'tanggal_lahir' => '1990-01-01',
//         'jam_lahir' => '12:00:00',
//         'waktu_lahir' => 'Pagi',
//         'anak_ke' => '2',
//         'jenis_kelahiran' => 'Normal',
//         'penolong_kelahiran' => 'Bidan',
//         'berat_bayi' => 3000,
//         'panjang_bayi' => 50,
//         'akta_kelahiran' => 'Ya',
//         'nomor_akta_kelahiran' => 123,
//         'tanggal_akta_kelahiran' => '1990-01-01',
//         'tempat_diterbitkan_ktp' => 'Kantor Desa',
//         'tanggal_diterbitkan_ktp' => '1990-01-01',
//         'nomor_kk' => 987654321,
//         'kedudukan_dalam_keluarga' => 'Anak Kedua',
//         'nik_ibu_kandung' => 1234567890123456,
//         'nik_ayah_kandung' => 1234567890123456,
//         'nama_ibu_kandung' => 'Jane Doe',
//         'nama_ayah_kandung' => 'John Doe Sr.',
//         'tempat_kematian' => 'Rumah Sakit',
//         'desa_atau_kelurahan' => 'Desa Contoh',
//         'kecamatan' => 'Kecamatan Contoh',
//         'kabupaten_atau_kota' => 'Kota Contoh',
//         'provinsi' => 'Provinsi Contoh',
//         'tanggal_kematian' => '1990-01-01',
//         'jam_kematian' => '12:00:00',
//         'waktu_kematian' => 'Sore',
//         'umur_saat_meninggal' => 32,
//         'sebab_kematian' => 'Sakit',
//         'yang_mengabarkan_kematian' => 'Famili',
//         'akta_kematian' => 'Ya',
//         'nomor_akta_kematian' => 456,
//         'tanggal_akta_kematian' => '1990-01-01',
//     ]);

//     // Memberikan respons bahwa data penduduk berhasil ditambahkan
//     return response()->json(['message' => 'Data Penduduk berhasil ditambahkan', 'data' => $penduduk], 201);
// });



