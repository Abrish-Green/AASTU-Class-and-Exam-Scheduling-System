<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\ErrorHandler\Debug;
use Illuminate\Support\Str;

use function Psy\debug;

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
        $admin= Auth::user();
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


    public function resetPassword(Request $request){

        try{
        $resetEmail = $request->email;
        $validated_data = $request->validate([
            'email' => 'required | email'
        ]);

        $user = Registrar::where('email',$validated_data['email'])->get();

        if($user->count() > 0){
           $username = $user[0]->name;
           $password  = Str::random(8);
           Registrar::where('email', $validated_data['email'])
                       ->update(['password' => Hash::make( $password )]);
            $data = array(
                'title' => 'Password Resetting Email',
                'name'=>"AASTU Class and Exam Scheduling System",
                'username' =>$username,
                'email' => $validated_data['email'],
                'password' => $password
            );
            Mail::send('mail', $data, function($message) use ($data) {

                $message->to($data['email'],$data['username'])->subject('Password Resetting Email');
                $message->from('Abrham365muche@gmail.com','Mr Abrham');
            });

            return response([
                'Message' => 'Successfully Sent. Please Check Your Email',
                'Status' => 'OK'
            ],200);
        }else{
            return response([
                'Message' => 'Email Doesn\'t Exists',
                'Status' => 'OK'
            ],200);

        }
    }catch(Exception $e){
            return response([
                'Error' => [$e]
            ],200);
         }


    }

}
