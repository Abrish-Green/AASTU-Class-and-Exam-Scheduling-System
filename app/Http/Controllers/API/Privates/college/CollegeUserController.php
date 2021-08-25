<?php

namespace App\Http\Controllers\API\PRIVATES\COLLEGE;

use App\Http\Controllers\Controller;
use App\Models\CollegeUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CollegeUserController extends Controller
{
    //
    public function register(Request $request){
        //
    try{
            $Validated = $request->validate([
                'name' => 'required',
                'email' => 'email|required',
                'password' => 'required',
                'college_id' => 'required'
            ]);

            //Check College
            $college = DB::table('colleges')->where('id',$Validated['college_id'])->first();

            if(!$college){
                return response([
                'Message' => 'College Not Found',
                    'Status' => 'OK'
                ],400);
            }
            $collegeUser = CollegeUser::create([
                'name' => $Validated['name'],
                'email' => $Validated['email'],
                'password' => Hash::make($Validated['password']),
                'remember_token' => '',
                'college_id' => $Validated['college_id']
            ]);

            $token = $collegeUser->createToken($Validated['email'])->plainTextToken;

            $response = [
                'CollegeUser' => $collegeUser,
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
        $collegeUser = CollegeUser::where('email',$Validated['email'])->first();

        if(!($collegeUser && Hash::check($Validated['password'],$collegeUser->password))){
                return response([
                    'Message' => 'College User Not Found',
                    'Status' => 'OK'
                ],400);
        }

        $token = $collegeUser->createToken('token')->plainTextToken;

        $response = [
            'Admin' => $collegeUser,
            'Token' => $token
        ];
        }catch(Exception $e){
            return response([
                    'Error' => [$e->getMessage() , $e->errors()]
                ]);
        }

        return response($response,200);
    }

    public function currentCollegeUser(Request $request)
    {
        return $request->user();
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

    public function sendEmailToCollege(Request $request){

    try{
            $resetEmail = $request->email;
            $validated_data = $request->validate([
                'email' => 'required | email'
            ]);

            $user = CollegeUser::where('email',$validated_data['email'])->get();

            if($user->count() > 0){
               $username = $user[0]->name;
               $password  = Str::random(8);
               CollegeUser::where('email', $validated_data['email'])
                           ->update(['password' => Hash::make( $password )]);
                $data = array(
                    'title' => 'College Dean Demo Account',
                    'name'=>"AASTU Class and Exam Scheduling System",
                    'username' =>$username,
                    'email' => $validated_data['email'],
                    'password' => $password
                );
                Mail::send('mail', $data, function($message) use ($data) {

                    $message->to($data['email'],$data['username'])->subject('Invitation for College Dean');
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
