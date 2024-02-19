<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;

class importController extends Controller
{
    public function index(){
        $users = User::get();


    }

    public function import()
    {
        try {
            Excel::import(new UsersImport, request()->file('file'));

            return response()->json([
                'message' => 'Data berhasil diimport'
            ]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { // Duplicate entry error code
                return response()->json([
                    'error' => 'Duplicate entry. Email already exists.',
                ], 422); // You can change the status code as needed
            }

            // Handle other database-related errors if necessary

            return response()->json([
                'error' => 'Error importing data.',
            ], 500); // Internal Server Error
        }
    }
}
