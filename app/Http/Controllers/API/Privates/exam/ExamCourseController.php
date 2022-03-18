<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
use App\Models\ExamCourses;
use App\Models\ExamSetting;
use App\Models\FinalExam;
use Illuminate\Http\Request;

class ExamCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */






    //get exam schedule


    public function getFinalExamSchedule(Request $request){
        $Validated = $request->validate([
            'college_id' => 'required',
            'department_id'=> 'required',
            'semester'=> 'required',
            'year'=> 'required',
            'section'=> 'required',
        ]);

        $FinalExamSchedule = FinalExam::where('college_id', $Validated['college_id'])
                                       ->where('department_id',$Validated['department_id'])
                                       ->where('semester',$Validated['semester'])
                                       ->where('year',$Validated['year'])
                                       ->where('class_name',$Validated['section'])
                                       ->get();


        if($FinalExamSchedule->count()> 0){
            return response([
                'Message' => 'Exam Schedule Found',
                'exam_schedule' => $FinalExamSchedule
            ],200);
        }else{
            return response([
                'Message' => 'Exam Schedule Not Found'
            ],200);
        }


    }


    public function getFinalClassSchedule(Request $request){
        $Validated = $request->validate([
            'college_id' => 'required',
            'department_id'=> 'required',
            'semester'=> 'required',
            'year'=> 'required',
            'section'=> 'required',
        ]);

        $FinalExamSchedule = FinalExamSchedule::where('college_id', $Validated['college_id'])
                                       ->where('department_id',$Validated['department_id'])
                                       ->where('semester',$Validated['semester'])
                                       ->where('year',$Validated['year'])
                                       ->where('class_name',$Validated['section'])
                                       ->get();


        if($FinalExamSchedule->count()> 0){
            return response([
                'Message' => 'Exam Schedule Found',
                'class_schedule' => $FinalExamSchedule
            ],200);
        }else{
            return response([
                'Message' => 'Exam Schedule Not Found'
            ],200);
        }


    }















    public function index()
    {
        //
        $ExamCourse = ExamCourses::all();

        return response([
            'exam_course' =>$ExamCourse,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);

    }
    public function getMyExamCourse(Request $request)
    {
        //
        $ExamCourse = ExamCourses::where('department_id', $request->department_id)->get();

        return response([
            'exam_course' =>$ExamCourse,
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
            'semester'=> 'required',
        ]);

        $Examcourse = ExamCourses::create([
            'course_id' => $Validated['course_id'],
            'department_id' =>$Validated['department_id'],
            'course_year' =>$Validated['course_year'],
            'semester' =>$Validated['semester'],
        ]);

        return response([
            'exam_course' =>$Examcourse,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function storeExamDate(Request $request)
    {
        //
        $Validated = $request->validate([
            'semester' => 'required',
            'starting_date'=> 'required',
            'ending_date'=> 'required',

        ]);

        $Examcourse = ExamSetting::create([

            'starting_date' =>$Validated['starting_date'],
            'ending_date' =>$Validated['ending_date'],
            'semester' =>$Validated['semester'],
        ]);

        return response([
            'setting' =>$Examcourse,
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
            'CREATED_DATA' =>$ExamCourse,
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
