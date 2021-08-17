<?php

namespace App\Http\Controllers\api\privates\course;

use App\Http\Controllers\Controller;
use App\Models\InstructorToCourse;
use Illuminate\Http\Request;

class CourseToInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $course_to_instructor = InstructorToCourse::all();
        return response([
            'CREATED_DATA' =>$course_to_instructor,
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
            'instructor_id' => $request->instructor_id,
            'course_id' => $request->course_id
        ]);

        $course_to_instructor = InstructorToCourse::create([
            'instructor_id' => $Validated['instructor_id'],
            'course_id' =>$Validated['course_id'],
        ]);
        return response([
            'CREATED_DATA' =>$course_to_instructor,
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
        $course_to_instructor = InstructorToCourse::findOrFail($id);

        if(!$course_to_instructor){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],400);
        }
        return response([
            'CREATED_DATA' =>$course_to_instructor,
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
        $course_to_instructor = InstructorToCourse::findOrFail($id);

        if(!$course_to_instructor){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],400);
        }

        $course_to_instructor->update($request->all());

        return response([
            'CREATED_DATA' =>$course_to_instructor,
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
        $course_to_instructor = InstructorToCourse::findOrFail($id);

        if(!$course_to_instructor){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],400);
        }

        $course_to_instructor->delete();

        return response([
            'Message' => 'Deleted Successfully',
            'Status' => 'OK'
        ],200);

    }
}
