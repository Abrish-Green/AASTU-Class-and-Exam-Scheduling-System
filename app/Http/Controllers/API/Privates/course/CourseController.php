<?php

namespace App\Http\Controllers\api\privates\course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $course = Course::all();
        return response([
            'R_DATA' =>$course,
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
        $Validated = $request->validate([
            'course_title' => 'required',
            'course_name' => 'required',
            'course_credit_hour' => 'required',
            'course_has_lab' => 'required',
            'course_type' => 'required',
            'course_department_id' => 'required',
        ]);

        $course = Course::create([
            'course_title' => $Validated['course_title'],
            'course_name' =>$Validated['course_name'],
            'course_credit_hour' =>$Validated['course_credit_hour'],
            'course_has_lab' =>$Validated['course_has_lab'],
            'course_type' =>$Validated['course_type'],
            'course_department_id' => $Validated['course_department_id'],
        ]);

        return response([
            'CREATED_DATA' =>$course,
            'Message' => 'Successful',
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
        $course = Course::findOrFail($id);

        if(!$course){
            return response([
                'Message' => 'Course Not Found',
                'Status' => 'OK'
            ],400);
        }
        return response([
            'DATA' =>$course,
            'Message' => 'Successful',
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
        //
        $course = Course::findOrFail($id);

        if(!$course){
            return response([
                'Message' => 'Course Not Found',
                'Status' => 'OK'
            ],400);
        }
        $Validated = $request->validate([
            'course_title' => 'required',
            'course_name' => 'required',
            'course_credit_hour' => 'required',
            'course_has_lab' => 'required',
            'course_type' => 'required',
            'course_department_id' => 'required',
        ]);

        if(!$Validated){
            return response([
                'Message' => 'Invalid input',
                'Status' => 'OK'
            ],301);
        }

        $isUpdated = $course->update($request->all());

        if($isUpdated){
            return response([
                'Message' => 'UnSuccessful',
                'Status' => 'OK'
            ],201);
        }
        return response([
            'Updated_DATA' =>$course,
            'Message' => 'Successful',
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
        $course = Course::findOrFail($id);
        if(!$course){
            return response([
                'Message' => 'Course Not Found',
                'Status' => 'OK'
            ],400);
        }
        Course::findOrFail($id)->delete();
        return response([
            'Message'=>'Course Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }
}
