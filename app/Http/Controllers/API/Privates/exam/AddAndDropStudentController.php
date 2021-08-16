<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
use App\Models\AddAndDropStudent;
use Illuminate\Http\Request;

class AddAndDropStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $add_and_drop = AddAndDropStudent::all();

        return response([
            'DATA' => $add_and_drop,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
