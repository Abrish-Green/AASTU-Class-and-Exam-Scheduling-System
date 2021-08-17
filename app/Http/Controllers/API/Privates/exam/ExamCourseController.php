<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
use App\Models\ExamCourses;
use Illuminate\Http\Request;

class ExamCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ExamCourse = ExamCourses::all();

        return response([
            'CREATED_DATA' =>$ExamCourse,
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
            'course_id' => 'required',
            'department_id'=> 'required',
            'course_year'=> 'required',
            'year'=> 'required',
            'semester'=> 'required',
        ]);

        $Examcourse = ExamCourses::create([
            'course_id' => $Validated['course_id'],
            'department_id' =>$Validated['department_id'],
            'course_year' =>$Validated['course_year'],
            'year' =>$Validated['year'],
            'semester' =>$Validated['semester'],
        ]);

        return response([
            'CREATED_DATA' =>$Examcourse,
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
        $ExamCourse = ExamCourses::findOrFail($id);

        if(!$ExamCourse){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'CREATED_DATA' =>$Examcourse,
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
        $ExamCourse = ExamCourses::findOrFail($id);

        if(!$ExamCourse){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }

        $ExamCourse->update($request->all());
        $Updated = ExamCourses::findOrFail($id);

        return response([
            'CREATED_DATA' => $Updated,
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
        $ExamCourse = ExamCourses::findOrFail($id);
        if(!$ExamCourse){
            return response([
                'Message' => 'Exam Course Not Found',
                'Status' => 'OK'
            ],400);
        }
        ExamCourses::findOrFail($id)->delete();
        return response([
            'Message'=>'Exam Course Successfully Deleted',
            'Status' => 'OK'
        ],200);

    }
}
