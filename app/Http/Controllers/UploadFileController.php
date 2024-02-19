<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{



    public function upload(Request $request)
    {
        // Validasi apakah request memiliki file yang diunggah
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx'
        ]);

        // Ambil file dari request
        $file = $request->file('file');

        // Ambil nama file asli
        $originalFileName = $file->getClientOriginalName();

        // Gunakan metode storeAs untuk menyimpan file dengan nama asli
        $path = $file->storeAs('public', $originalFileName);

        // Dapatkan URL file yang telah diupload
        $url = Storage::url($path);

        return response()->json([
            'message' => 'berhasil',
            'path' => $path,
            'url' => 'http://localhost:8000' . $url
        ]);

    }

    public function getFile($filename)
{
    $filePath = storage_path('app/public/' . $filename);

    if (file_exists($filePath)) {
        return response()->file($filePath);
    } else {
        return response()->json([
            'message' => 'File not found'
        ], 404);
    }
}

}
