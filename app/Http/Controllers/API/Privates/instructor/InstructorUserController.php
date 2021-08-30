<?php

namespace App\Http\Controllers\Api\Privates\instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InstructorUserController extends Controller
{


    public function getMyInstructors($id){

        try{

            $instructors = Instructor::where('department_id', $id)->get();
            return response([
                'instructors' => $instructors,
                'Message' => 'Successful'
            ],200);

        }catch(Exception $e){

            return response([
                'Error' => [$e->getMessage() , $e->errors()]
            ],200);

        }

    }



    public function register(Request $request)
    {
        //
        try{
            $Validated = $request->validate([
                'name' => 'required',
                'email' => 'email|required', //|unique:instructors
                'password' => 'required',
                'active' => 'required',
                'department_id' => 'required'
            ]);

            //Check department
            $department = DB::table('departments')->where('id',$Validated['department_id'])->first();
           // dd($department);
            if(!$department){
                return response([
                'Message' => 'Department Not Found',
                    'Status' => 'OK'
                ],200);
            }
            $instructor = Instructor::create([
                'name' => $Validated['name'],
                'email' => $Validated['email'],
                'password' => Hash::make($Validated['password']),
                'remember_token' => '',
                'department_id' => $Validated['department_id']
            ]);

            $token = $instructor->createToken($Validated['email'])->plainTextToken;

            $response = [
                'instructor' => $instructor,
                'token' => $token
            ];

     }catch(Exception $e){
        return response([
            'Error' => [$e->getMessage() , $e->errors()]
        ],200);
     }

        return response($response,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //

        try{

            $Validated = $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

        //Check Email
        $instructor = Instructor::where('email',$Validated['email'])->first();
        //dd($departmentUser);
        if(!($instructor && Hash::check($Validated['password'],$instructor->password))){
                return response([
                    'Message' => 'Instructor User Not Found',
                    'Status' => 'OK'
                ],400);
        }

        $token = $instructor->createToken('token')->plainTextToken;

        $response = [
            'Instructor' => $instructor,
            'Token' => $token
        ];
        }catch(Exception $e){
            return response([
                 'Error' => [$e->getMessage() , $e->errors()]
            ]);
        }

        return response($response,200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //
        auth()->user()->tokens()->delete();

        return response([
            'Message' => 'Logged out',
            'Status' => 'OK'
        ],200);
    }

    public function currentUser(Request $request){
        return $request->user();
    }
    public function delete($id){
        $instructor = Instructor::findOrFail($id);
        if(!$instructor){
            return response([
                'Message' => 'Instructor Not Found',
                'Status' => 'OK'
            ],400);
        }
        Instructor::findOrFail($id)->delete();
        return response([
            'Message'=>'Instructor Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }

    public function update(Request $request,$id){

         $instructor = Instructor::findOrFail($id)->update($request->all());

         if(!$instructor){
             return response([
                 'Message' => 'Instructor Not Updated',
                 'Status' => 'OK'
             ],400);

         }
         return response([
             'Updated' => $instructor,
             'Message'=>'Instructor Successfully Updated',
             'Status' => 'OK'
         ],200);

    }
    public function GenerateDefaultPassword(Request $request,$id){

        $Validated = $request->validate([
            'email' => 'email\required',
        ]);

        $instructor = Instructor::findOrFail($id);

        if(!$instructor){
            return response([
                'Message' => 'Instructor Not Updated',
                'Status' => 'OK'
            ],400);
        }

        $DEFAULT_PASSWORD = Hash::make('default');
        $isUpdated = $instructor->update([
            'password' => $DEFAULT_PASSWORD
        ]);

        if(!$isUpdated){
            return response([
                'Message' => 'Not Updated',
                'Status' => 'OK'
            ],400);
        }

        return response([
            'Updated_DATA' => $instructor,
            'Message' => 'Instructor is Updated Successfully',
            'Status' => 'OK'
        ],200);


    }

    public function send_email_to_instructor(Request $request){

        try{
                $resetEmail = $request->email;
                $validated_data = $request->validate([
                    'email' => 'required | email'
                ]);

                $user = Instructor::where('email',$validated_data['email'])->get();

                if($user->count() > 0 || true){
                   $username = $user[0]->name;
                   $password  = Str::random(8);
                   Instructor::where('email', $validated_data['email'])
                               ->update(['password' => Hash::make( $password )]);
                    $data = array(
                        'title' => 'Instructor Demo Account',
                        'name'=>"AASTU Class and Exam Scheduling System",
                        'username' =>$username,
                        'email' => $validated_data['email'],
                        'password' => $password
                    );
                    Mail::send('mail', $data, function($message) use ($data) {

                        $message->to($data['email'],$data['username'])->subject('Invitation for Instructor');
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


        public function destroy($id)
        {
            //

            $departmentHead = Instructor::findOrFail($id);
            if(!$departmentHead){
                return response([
                    'Message' => 'Instructor Not Found',
                    'Status' => 'OK'
                ],200);
            }
            Instructor::find($id)->delete();
            return response([
                'Message'=>'Instructor Successfully Deleted',
                'Status' => 'OK'
            ],200);
        }






}
