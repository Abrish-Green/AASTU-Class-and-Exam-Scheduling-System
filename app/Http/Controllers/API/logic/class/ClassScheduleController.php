<?php

namespace App\Http\Controllers\api\logic\class;

use App\Http\Controllers\Controller;
use App\Models\ClassBlockRoom;
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







    public function AssignRoom(){

        $EverySection = Classes::all();
        $EveryExamCourse = Course::all();
        $EveryFinalExam = FinalExam::all();



        foreach ($EverySection as $section) {

            $yearRoom = ClassBlockRoom::where('year',$section->year)->where('department_id',$section->department_id)->get();
            echo "Year $section->year $section->class_name<br />";
            if($yearRoom->count() > 0){
                foreach ($yearRoom as $roomRow) {
                        echo "ROW - $roomRow <br />";

                        echo "Assign Block-$roomRow->block ,Room - $roomRow->room<br />";


                        $check = FinalClassSchedule::where('block',$roomRow->block)
                                   ->where('room',$roomRow->room)->get();

                            if($check->count() > 0){

                            }else{
                                FinalClassSchedule::where('class_id',$section->id)->update([
                                    'block' => $roomRow->block,
                                    'room' => $roomRow->room
                                ]);
                            }




                }
                echo "<br />";

            }
        }



    }



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



            if(FinalClassSchedule::where('class_id',$sections->id)->count() > 0){
                continue;
            }

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

        $courseArray = array();
        foreach ($EverySection as $sections) {


            $EveryYearCourse = Course::where('year',$sections->year)
                                        ->where('department_id',$sections->department_id)->get();
            $courseAmount =  $EveryYearCourse->count();
                echo  "$sections->year $sections->class_name - course Amount -  $courseAmount<br />";

            //generate course amount size number of string

            $courses = array();
            foreach ($EveryYearCourse as $key => $course) {
                array_push($courses,$course);
            }

            $courseList = array();
            for($i=0;$i<$courseAmount;$i++){
                array_push($courseList,$i);
            }

                // Shuffle numbers
                shuffle($courseList);
                print_r($courseList);
                echo "<br />";
                foreach ($EveryYearCourse as $key => $section) {
                   echo "--------------------key - $key ---$section->course_title <br>";

                    $FinalClassSchedule = FinalClassSchedule::where('class_id',$sections->id)
                                                            ->where('day',$DayName[$key])
                                                            ->where('class_name',$sections->class_name)

                                                            ->get();



                    foreach($FinalClassSchedule as $row){



                        if($key == ($courseAmount-1)){
                            $key;
                        }else{
                            $key =  $key;
                        }



                        if($row->day == $DayName[$key]){
                            $temp = $courseList[$key];
                            echo "Day ". $row->day. $courses[$temp]->course_title .  "<br>";

                        $CheckFinalClassScheduleExists = FinalClassSchedule::where('class_id',$sections->id)
                            ->where('day',$DayName[$key])
                            ->where('class_name',$sections->class_name)
                            ->where('session','2:30 - 3:20')
                            ->where('course_id',$courses[$temp]->id)
                            ->get()->count();



                            if($CheckFinalClassScheduleExists == 0){

                            $CheckFinalClassSchedule = FinalClassSchedule::where('class_id',$sections->id)
                            ->where('day',$DayName[$key])
                            ->where('class_name',$sections->class_name)
                            ->where('session','2:30 - 3:20')
                            ->where('course_id',$courses[$temp]->id)
                            ->get();
                    if($CheckFinalClassSchedule->count() > 0){
                        break;
                    }

                FinalClassSchedule::where('class_id',$sections->id)
                ->where('class_name',$sections->class_name)
                ->where('day',$DayName[$key])
                                        ->where('session','2:30 - 3:20')
                                        ->update([
                                                'course_id' => $courses[$temp]->id,
                                                'course_title' => $courses[$temp]->course_title,
                                                'course_code' =>$courses[$temp]->course_code,
                                                'course_credit_hour' => $courses[$temp]->course_credit_hour,


                    ]);
                FinalClassSchedule::where('class_id',$sections->id)
                ->where('class_name',$sections->class_name)
                ->where('day',$DayName[$key])
                                        ->where('session','3:30 - 4:20')
                                        ->update([
                                                'course_id' => $courses[$temp]->id,
                                                'course_title' => $courses[$temp]->course_title,
                                                'course_code' =>$courses[$temp]->course_code,
                                                'course_credit_hour' => $courses[$temp]->course_credit_hour,


                    ]);


                if($courses[$temp]->course_has_lab){
                    ///echo "Has LAB<BR />";
                    FinalClassSchedule::where('class_id',$sections->id)
                    ->where('class_name',$sections->class_name)
                    ->where('day',$DayName[$key])
                                        ->where('session','7:30 - 8:20')
                                        ->update([
                                                'course_id' => $courses[$temp]->id,
                                                'course_title' => $courses[$temp]->course_title . "(LAB)",
                                                'course_code' =>$courses[$temp]->course_code,
                                                'course_credit_hour' => $courses[$temp]->course_credit_hour,
                                                'has_lab' => true

                    ]);
                    FinalClassSchedule::where('class_id',$sections->id)
                    ->where('class_name',$sections->class_name)
                    ->where('session','8:30 - 9:20')
                    ->where('day',$DayName[$key])
                    ->update([
                            'course_id' => $courses[$temp]->id,
                            'course_title' => $courses[$temp]->course_title . "(LAB)",
                            'course_code' =>$courses[$temp]->course_code,
                            'course_credit_hour' => $courses[$temp]->course_credit_hour,
                            'has_lab' => true

]);
                FinalClassSchedule::where('class_id',$sections->id)
                                ->where('class_name',$sections->class_name)
                                ->where('day',$DayName[$key])
                                ->where('session','9:30 - 10:20')
                                ->update([
                                        'course_id' => $courses[$temp]->id,
                                        'course_title' => $courses[$temp]->course_title . "(LAB)",
                                        'course_code' =>$courses[$temp]->course_code,
                                        'course_credit_hour' => $courses[$temp]->course_credit_hour,
                                        'has_lab' => true

                    ]);


                }


                            }




                        }else{
                            $temp = $courseList[$key];
                            $CheckFinalClassSchedule = FinalClassSchedule::where('class_id',$sections->id)
                            ->where('day',$DayName[$key])
                            ->where('class_name',$sections->class_name)
                            ->where('session','2:30 - 3:20')
                            ->where('course_id',$courses[$temp]->id)
                            ->get();
                    if($CheckFinalClassSchedule->count() > 0){
                        break;
                    }

                FinalClassSchedule::where('class_id',$sections->id)
                ->where('class_name',$sections->class_name)
                ->where('day',$DayName[$key])
                                        ->where('session','2:30 - 3:20')
                                        ->update([
                                                'course_id' => $courses[$temp]->id,
                                                'course_title' => $courses[$temp]->course_title,
                                                'course_code' =>$courses[$temp]->course_code,
                                                'course_credit_hour' => $courses[$temp]->course_credit_hour,


                    ]);
                FinalClassSchedule::where('class_id',$sections->id)
                ->where('class_name',$sections->class_name)
                ->where('day',$DayName[$key])
                                        ->where('session','3:30 - 4:20')
                                        ->update([
                                                'course_id' => $courses[$temp]->id,
                                                'course_title' => $courses[$temp]->course_title,
                                                'course_code' =>$courses[$temp]->course_code,
                                                'course_credit_hour' => $courses[$temp]->course_credit_hour,


                    ]);

                        }

                    }


                }









            }//end of foreach






            $EverySection = Classes::all();
        $EveryExamCourse = Course::all();
        $EveryFinalExam = FinalExam::all();



        foreach ($EverySection as $section) {

            $yearRoom = ClassBlockRoom::where('year',$section->year)->where('department_id',$section->department_id)->get();
            echo "Year $section->year $section->class_name<br />";
            if($yearRoom->count() > 0){
                foreach ($yearRoom as $roomRow) {
                        echo "ROW - $roomRow <br />";

                        echo "Assign Block-$roomRow->block ,Room - $roomRow->room<br />";


                        $check = FinalClassSchedule::where('block',$roomRow->block)
                                   ->where('room',$roomRow->room)->get();

                            if($check->count() > 0){

                            }else{
                                FinalClassSchedule::where('class_id',$section->id)->update([
                                    'block' => $roomRow->block,
                                    'room' => $roomRow->room
                                ]);
                            }




                }
                echo "<br />";

            }
        }





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
