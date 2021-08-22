<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function register(Request $request)
    {
        //

        $Validated = $request->validate([
            'username' => 'required',
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $CheckEmail = Registrar::where('email', $Validated['email'])->count();
        if($CheckEmail > 0) {
            return response([
                'Message' => 'Email Already Exists',
                'Status' => 'OK'
            ],200);
        }
        $adminUser = Registrar::create([
            'name' => $Validated['username'],
            'email' => $Validated['email'],
            'password' => Hash::make($Validated['password'])
        ]);

        $token = $adminUser->createToken($Validated['email'])->plainTextToken;

        $response = [
            'Admin' => $adminUser,
            'Token' => $token
        ];

        return response($response,200);
    }

    public function login(Request $request){

        try{
        $Validated = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        //Check Email
        $adminUser = Registrar::where('email',$Validated['email'])->first();

        if(!($adminUser && Hash::check($Validated['password'],$adminUser->password))){
                return response([
                    'Message' => 'User Not Found'
                ],200);
        }

        $token = $adminUser->createToken('token')->plainTextToken;

        $response = [
            'Admin' => $adminUser,
            'Token' => $token
        ];
        }catch(Exception $e){
            return response(
               [ 'err' => $e]
            );
        }

        return response($response,201);
    }

    public function admin(Request $request)
    {
        $admin=Auth::user();
        return $admin;
    }

    public function logout(Request $request)
    {
        //
        auth()->user()->tokens()->delete();

        $response = [
            'Message' => 'Logged out'
        ];

        return $response;
    }
}
