<?php

namespace App\Http\Controllers\api\logic\exam;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\College;
use App\Models\Department;
use App\Models\ExamClassSection;
use App\Models\ExamSetting;
use App\Models\FinalExam;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ExamScheduleController extends Controller
{
    //

    //Step to Schedule Exams
    //======================
    //Step-1 //flag true

    //Step-2 // assign exam date by calculating total number of exam : exam days

    //Step-3 //assign common course (use course code)

    //Step-4 //assign Department course

    //Step-5 //Supporting



    //Implementation

    public function MakeFinalExamSchedule(){

        $semester = 1;
        $EverySection = ExamClassSection::all();
        $result = array();
        foreach ($EverySection as $section) {

            //create table of final_exams

           $department_id = $section->department_id;
           $department_name = Department::findOrFail($department_id)->name;
           $college_id = Department::findOrFail($department_id)->colleges->id;
           $college_name = Department::findOrFail($department_id)->colleges->name;

           $exam_start_date = ExamSetting::where('semester', $semester)->get()[0]->starting_date;
           $exam_ending_date = ExamSetting::where('semester', $semester)->get()[0]->ending_date;
           $exam_start_day = substr( $exam_start_date,8);
           $exam_ending_day = substr( $exam_ending_date,8);
           $exam_length= substr(($exam_start_day - $exam_ending_day),1);
           $exam_day_counter = ($exam_start_day)/1;
           echo '-------------<br />';
            for($i=1;$i<=$exam_length;$i++){

                if($exam_day_counter >= 30){
                    $exam_day_counter = 1;
                }

                if( in_array($exam_day_counter,[1,2,3,4,5,6,7,8,9])){
                    $exam_full_date = '2021-09-0'.$exam_day_counter .substr(now(),10);
                }else{
                    $exam_full_date = '2021-09-'.$exam_day_counter .substr(now(),10);
                }

                //echo $exam_full_date . "<br />";


                $hour =substr($exam_full_date,11,2);
                $min = substr($exam_full_date,14,2);
                $second =substr($exam_full_date,17);
                $day=substr($exam_full_date,8,3);
                $month=substr($exam_full_date,5,2);
                $year= substr($exam_full_date,0,4);

                $real = mktime($hour,$min,$second,$month,$day,$year);
                //echo date("l F jS, Y - g:ia", $real ) . '<br/>';



                if(date("l", $real ) == "Saturday" || date("l", $real ) =="Sunday"){
                    echo "Saturday and Sunday  " . '<br />';
                    $finalExam = FinalExam::create([
                        'flag' => false ,
                        'course_id' => 1,
                        'invigilator_1'=> '',
                        'session'=> '',
                        'room' => '',
                        'block'=> '',
                        'exam_date'=> '',
                        'day'=> '',
                        'course_title'=> '',
                        'course_code'=> '',
                        'class_id'=> $section->id,
                        'college_id'=> $college_id,
                        'department_id'=> $department_id,
                        'class_name'=> '',
                        'invigilator_2'=> '',

                ]);
                }else{
                    $finalExam = FinalExam::create([
                        'flag' => true ,
                        'course_id' => 1,
                        'invigilator_1'=> '',
                        'session'=> '',
                        'room' => '',
                        'block'=> '',
                        'exam_date'=> '',
                        'day'=> '',
                        'course_title'=> '',
                        'course_code'=> '',
                        'class_id'=> $section->id,
                        'college_id'=> $college_id,
                        'department_id'=> $department_id,
                        'class_name'=> '',
                        'invigilator_2'=> '',

                ]);
            }
              //echo "DAY - " . $exam_day_counter . '<br />';
              $exam_day_counter++;
            }

        }

    }

}
