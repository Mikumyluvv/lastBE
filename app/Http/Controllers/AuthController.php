<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        // $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            // 'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|string ',
            'password'=>'required|string '
        ]);

        // cek email
        $user = User::where('email', $data['email'])->first();
        // cek pw
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'messge' => 'ada yang salah'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token

        ];

        return response()->json($response, 201);
    }


    public function logout(Request $request){
        $user = auth()->user();
        $userEmail = $user->email;
        $user->tokens()->delete();

        return [
            'email' => $userEmail,
            'message' => 'logout'
        ];
    }

}









// public function logout(Request $request){
    //     // $user = User::all();
    //     $user = auth::user();
    //     $user()->tokens()->delete();

    //     return [
    //         'akun' => $user->email,
    //         'message' => 'logout'
    //     ];

    //     return response()->json($data, 200);
    // }

    // public function logout(Request $request){
    //     $user = auth::user(); // Menggunakan Auth untuk mendapatkan user yang sedang login
    //     $user->tokens()->delete(); // Menghapus semua token yang dimiliki user
    //     $data = [
    //         'email' => $user->email,
    //         'message' => 'logout'
    //     ];

    //     return response()->json($data, 200);
    // }


    // public function logout(Request $request){
    //     auth()->user()->tokens()->delete();

    //     return[
    //         'message' => "ilang cok"
    //     ];
    // }
