<?php

namespace App\Http\Controllers\api\privates\course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOWner;
use App\Models\Department;
use Exception;
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

    public function getMyCourses(Request $request)
    {
        //
        $course = Course::where('department_id', $request->department_id)->get();


        try{
        if(Department::findOrFail($request->department_id)->count() == 0){
            return response([
                'Message' => 'Department Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'courses' =>$course,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
        }catch(Exception $e){
            return response([
                'ERROR'=> $e,
                'Message' => 'Successful',
                'Status' => 'Fail'
            ],200);
        }
    }


    public function getYearMyCourses(Request $request)
    {
        //
        $course = Course::where('department_id', $request->department_id)
                        ->where('year',$request->year)
                        ->get();

        try{
        if(Department::findOrFail($request->department_id)->count() == 0){
            return response([
                'Message' => 'Department Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'courses' =>$course,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
        }catch(Exception $e){
            return response([
                'ERROR'=> $e,
                'Message' => 'Successful',
                'Status' => 'Fail'
            ],200);
        }
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
            'year' => 'required',
            'course_code' => 'required',
            'course_credit_hour' => 'required',
            'course_has_lab' => 'required',
            'course_has_lecture' => 'required',
            'course_type' => 'required',
            'department_id' => 'required',
        ]);

        $didCourseExist = Course::where('course_code', $Validated['course_code'])->get();

        if($didCourseExist->count() > 0){
            return response([
                'course' => null,
                'Message' => 'Course Already Exists',
                'Status' => 'OK'
            ],200);
        }

        $course = Course::create([
            'course_title' => $Validated['course_title'],
            'year' => $Validated['year'],
            'course_code' =>$Validated['course_code'],
            'course_credit_hour' =>$Validated['course_credit_hour'],
            'course_has_lab' =>$Validated['course_has_lab'],
            'course_has_lecture' =>$Validated['course_has_lecture'],
            'course_type' =>$Validated['course_type'],
            'department_id' => $Validated['department_id'],
        ]);

        return response([
            'course' =>$course,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function giveCourseOwnership(Request $request)
    {
        //
        $Validated = $request->validate([
            'course_id' => 'required',
            'department_id' => 'required',
        ]);
        $course = CourseOWner::create([
            'course_id' =>$Validated['course_id'],
            'department_id' => $Validated['department_id'],
        ]);

        return response([
            'course' =>$course,
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
        $Validated = $request->validate([
            'course_title' => 'required',
            'year' => 'required',
            'course_code' => 'required',
            'course_credit_hour' => 'required',
            'course_has_lab' => 'required',
            'course_has_lecture' => 'required',
            'course_type' => 'required',
            'department_id' => 'required',
        ]);

        $course = Course::findOrFail($id);

        if(!$course){
            return response([
                'Message' => 'Course Not Found',
                'Status' => 'OK'
            ],400);
        }


        if(!$Validated){
            return response([
                'Message' => 'Invalid input',
                'Status' => 'OK'
            ],301);
        }

        $isUpdated = $course->update([
            'course_title' => $Validated['course_title'],
            'year' => $Validated['year'],
            'course_code' =>$Validated['course_code'],
            'course_credit_hour' =>$Validated['course_credit_hour'],
            'course_has_lab' =>$Validated['course_has_lab'],
            'course_has_lecture' =>$Validated['course_has_lecture'],
            'course_type' =>$Validated['course_type'],
            'department_id' => $Validated['department_id'],
        ]);

        if($isUpdated){
            return response([
                'Message' => 'UnSuccessful',
                'Status' => 'OK'
            ],200);
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
            ],200);
        }
        Course::findOrFail($id)->delete();
        return response([
            'Message'=>'Course Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }
}
