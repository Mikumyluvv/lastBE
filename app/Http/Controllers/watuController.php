<?php

namespace App\Http\Controllers;
use App\Imports\watu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;



class WATUController extends Controller
{
    public function import()
    {

            Excel::import(new watu, request()->file('file'));
            return response()->json([
                'message' => 'Data berhasil diimport'
            ]);

    }
}
