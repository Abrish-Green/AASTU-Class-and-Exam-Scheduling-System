<?php

namespace App\Http\Controllers\api\privates\department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DepartmentUserController extends Controller
{
    //
    public function register(Request $request){

    try{
            $Validated = $request->validate([
                'name' => 'required',
                'email' => 'email|required',
                'password' => 'required',
                //'active' => 'required',
                'department_id' => 'required',
                'college_id' => 'required'
            ]);

            //Check College
            $department = DB::table('departments')->where('id',$Validated['department_id'])->first();
            //dd($department);
            if(!$department){
                return response([
                'Message' => 'Department Not Found',
                    'Status' => 'OK'
                ],200);
            }
            $departmentUser = DepartmentUser::create([
                'name' => $Validated['name'],
                'email' => $Validated['email'],
                'password' => Hash::make($Validated['password']),
                'remember_token' => '',
                'department_id' => $Validated['department_id'],
                'college_id' => $Validated['college_id']
            ]);

            $token = $departmentUser->createToken($Validated['email'])->plainTextToken;

            $response = [
                'DepartmentUser' => $departmentUser,
                'Token' => $token
            ];

     }catch(Exception $e){
        return response([
            'Error' => [$e->getMessage()]
        ],200);
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

    public function send_email_to_head(Request $request){

        try{
                $resetEmail = $request->email;
                $validated_data = $request->validate([
                    'email' => 'required | email'
                ]);

                $user = DepartmentUser::where('email',$validated_data['email'])->get();

                if($user->count() > 0 || true){
                   $username = $user[0]->name;
                   $password  = Str::random(8);
                   DepartmentUser::where('email', $validated_data['email'])
                               ->update(['password' => Hash::make( $password )]);
                    $data = array(
                        'title' => 'Department Head Demo Account',
                        'name'=>"AASTU Class and Exam Scheduling System",
                        'username' =>$username,
                        'email' => $validated_data['email'],
                        'password' => $password
                    );
                    Mail::send('mail', $data, function($message) use ($data) {

                        $message->to($data['email'],$data['username'])->subject('Invitation for Department Head');
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



    public function getMyDepartmentHeads(Request $request){


        $myCollegeDepartmentHeads = DepartmentUser::where('college_id',$request->college_id)->get();

          return response([
              'CREATED_DATA' =>$myCollegeDepartmentHeads,
              'Message' => 'Successful',
              'Status' => 'OK'
          ],200);



    }

    public function destroy($id)
    {
        //

        $departmentHead = DepartmentUser::findOrFail($id);
        if(!$departmentHead){
            return response([
                'Message' => 'Department Head Not Found',
                'Status' => 'OK'
            ],200);
        }
        DepartmentUser::findOrFail($id)->delete();
        return response([
            'Message'=>'Department Head Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }

    public function edit(Request $request, $id){
        $department_head = DepartmentUser::findOrFail($id);

        if(!$department_head){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }

        $department_head->update($request->all());

        return response([
            'CREATED_DATA' =>$department_head,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);

    }
}


