<?php

namespace App\Http\Controllers\API\Privates\department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentAccountController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return response([
            'department' => $department
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
        $Validated = $request->validate([
            'name' => 'required',
        ]);

  // dd();
        $department = Department::create([
            'name' => $Validated['name'],
            'college_id' => Auth::user()->department->college_id
        ]);
        return response([
            'Department' => $department,
            'Message'=>'Department Successfully Created',
            'Status' => 'OK'
        ],200);
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
        $department = Department::findOrFail($id);
        if(!$department){
            return response([
                'Message' => 'Department Not Found',
                'Status' => 'OK'
            ],401);
        }

        return response([
            'department' => $department,
            'Message' => 'Department Found',
            'Status' => 'OK'
        ],200);
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
        $Validated = $request->validate([
           'name' => 'required'
        ]);


        $department = Department::findOrFail($id)->update(
            ['name' => $Validated['name']
        ]);

        if(!$department){
            return response([
                'Message' => 'Department Not Updated',
                'Status' => 'OK'
            ],400);

        }
        return response([
            'Updated' => $department,
            'Message'=>'Department Successfully Updated',
            'Status' => 'OK'
        ],200);

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

        $department = Department::findOrFail($id);
        if(!$department){
            return response([
                'Message' => 'Department Not Found',
                'Status' => 'OK'
            ],400);
        }
        Department::findOrFail($id)->delete();
        return response([
            'Message'=>'Department Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }

}
