<?php

namespace App\Http\Controllers\api\privates\department;

use App\Http\Controllers\Controller;
use App\Models\DepartmentUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentUserController extends Controller
{
    //
    public function register(Request $request){

    try{
            $Validated = $request->validate([
                'name' => 'required',
                'email' => 'email|required|unique:department_users',
                'password' => 'required',
                //'active' => 'required',
                'department_id' => 'required'
            ]);

            //Check College
            $department = DB::table('departments')->where('id',$Validated['department_id'])->first();
            //dd($department);
            if(!$department){
                return response([
                'Message' => 'Department Not Found',
                    'Status' => 'OK'
                ],400);
            }
            $departmentUser = DepartmentUser::create([
                'name' => $Validated['name'],
                'email' => $Validated['email'],
                'password' => Hash::make($Validated['password']),
                'remember_token' => '',
                'department_id' => $Validated['department_id']
            ]);

            $token = $departmentUser->createToken($Validated['email'])->plainTextToken;

            $response = [
                'CollegeUser' => $departmentUser,
                'Token' => $token
            ];

     }catch(Exception $e){
        return response([
            'Error' => [$e->getMessage() , $e->errors()]
        ],400);
     }

        return response($response,200);
    }


    public function login(Request $request){

        try{

            $Validated = $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

        //Check Email
        $departmentUser = DepartmentUser::where('email',$Validated['email'])->first();
        //dd($departmentUser);
        if(!($departmentUser && Hash::check($Validated['password'],$departmentUser->password))){
                return response([
                    'Message' => 'Department User Not Found',
                    'Status' => 'OK'
                ],400);
        }

        $token = $departmentUser->createToken('token')->plainTextToken;

        $response = [
            'Admin' => $departmentUser,
            'Token' => $token
        ];
        }catch(Exception $e){
            return response([
                 'Error' => [$e->getMessage() , $e->errors()]
            ]);
        }

        return response($response,200);
    }

    public function currentDepartmentUser(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        //
        auth()->user()->tokens()->delete();

        return response([
            'Message' => 'Logged out',
            'Status' => 'OK'
        ],200);
    }
}
