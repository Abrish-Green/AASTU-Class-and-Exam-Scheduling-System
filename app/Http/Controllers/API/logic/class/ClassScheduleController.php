<?php

namespace App\Http\Controllers\api\logic\class;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Department;
use App\Models\FinalClassSchedule;
use App\Models\FinalExam;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FinalClassPass;

class ClassScheduleController extends Controller
{
    //





    //Steps needed to Implement this Algorithm
    //---------------------------------------
    //Step-1 : create 5 day for every section





    public function MakeClassSchedule(){


        //global variable
        $EverySection = Classes::all();
        $DayName = array(null,'Monday','Tuesday','Wednesday','Thursday','Friday');
        $session = array(null,'2:30 - 3:20','3:30 - 4:20','4:30 - 5:20','5:30 - 6:20','7:30 - 8:20','8:30 - 9:20','9:30 - 10:20','10:30 - 11:20');




        //create 5 day for every Section

        foreach ($EverySection as $sections) {
            //get detail names
            $department_id = $sections->department_id;
            $department_name = Department::findOrFail($department_id)->name;
            $college_id = Department::findOrFail($department_id)->colleges->id;
            $college_name = Department::findOrFail($department_id)->colleges->name;


            //echo "<br /> $sections  <br />";

            for($i=1;$i<=5;$i++){
                //five day loop
                //echo "<br />  Day $i   <br />";

                //with in the day there are 8 time slots

                    for($j=1;$j<=8;$j++){

                        if(FinalClassSchedule::where('class_id',$sections->id)->count() <= 40){
                            FinalClassSchedule::create([

                                'class_id' => $sections->id,
                                'course_id'=> '',
                                'course_code'=>'',
                                'course_title' =>'',
                                'course_credit_hour' =>'',
                                'session'=> $session[$j],
                                'room'=>'',
                                'block'=>'',
                                'day'=> $DayName[$i],
                                'class_name'=>$sections->class_name,
                                'semester'=>$sections->semester,
                                'year' => $sections->year,
                                'has_lab'=> false,
                                'lab_name'=>'',
                                'lab_id'=>'',
                                'instructor'=>'',
                                'instructor_id'=>0,
                                'department_name' => $department_name,
                                'etw' => false,
                                'college_name' => $college_name,
                                'department_id'=> $department_id,
                                'college_id' => $college_id
                            ]);
                     } //end of if

                    }

             } //end of for loop






            // echo "<br/> Day Created Successfully<br />";
        } //end of foreach


        //Assign Course

        $prevCourse = '';
        $courses_used = '';
        $random = '';
    foreach ($EverySection as $section) {




        }//end of foreach








    } //end of function



}


/**
 *  FinalClassSchedule::where('department_id',$section->department_id)
                                                ->where('year',$section->year)
                                                ->where('class_id',$section->id)
                                                ->where('session','2:30 - 3:20')
                                                ->update([
                                                    'course_id' => $course->id,
                                                    'course_title' => $course->course_title,
                                                    'course_code' => $course->course_code,
                                                    'course_credit_hour' => $course->course_credit_hour,
                                                    'has_lab' => true

                                                ]);
 */
