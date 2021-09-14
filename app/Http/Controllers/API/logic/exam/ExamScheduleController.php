<?php

namespace App\Http\Controllers\api\logic\exam;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\College;
use App\Models\Course;
use App\Models\Department;
use App\Models\ExamClassSection;
use App\Models\ExamCourses;
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
        $EveryExamCourse = ExamCourses::all();
        $EveryFinalExam = FinalExam::all();
        $year = array(1,2,3,4,5,6);
        $result = array();
        $session_for_exam = array([
                'common_course'=> '8:30 AM (Morning)',
                '1'=>'8:30 AM (Morning)
                ','2'=>'8:30 AM (Morning)
                ','3'=>'7:30PM (Afternoon)
                ','4'=>'8:30 AM (Morning)
                ','5'=>'7:30PM (Afternoon)
                ','6'=>'8:30 AM (Morning)
                ']);
        foreach ($EverySection as $section) {  //holds section

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






           //create the first database
     if(FinalExam::where('class_id', $section->id)->get()->count() == 0){
           for($i=0;$i<=$exam_length;$i++){

                if($exam_day_counter >= 30){
                    $exam_day_counter = 1;
                }

                if( in_array($exam_day_counter,[1,2,3,4,5,6,7,8,9])){
                    $exam_full_date = '2021-09-0'.$exam_day_counter .substr(now(),10);
                }else{
                    $exam_full_date = '2021-09-'.$exam_day_counter .substr(now(),10);
                }

                $hour =substr($exam_full_date,11,2);
                $min = substr($exam_full_date,14,2);
                $second =substr($exam_full_date,17);
                $day=substr($exam_full_date,8,3);
                $month=substr($exam_full_date,5,2);
                $year= substr($exam_full_date,0,4);

                $real = mktime($hour,$min,$second,$month,$day,$year);
                //echo date("l F jS, Y - g:ia", $real ) . '<br/>';




                if(date("l", $real ) == "Saturday" || date("l", $real ) =="Sunday"){
                    //Satuday , Sunday
                }else{

                    echo $section->year;

                    $ExamAmount = ExamCourses::where('course_year', $section->year)->get()->count();
                    echo "$ExamAmount" . $ExamAmount;
                    if($ExamAmount == 0){
                        continue;
                    }
                    $ExamDaySpace = (floor( ($exam_length)/$ExamAmount))-1;
                    $tempExamDay = 0;
                    $tempIncrementer = $ExamDaySpace;
                    $tempExamDay =$exam_day_counter;

                    echo '<br />-----------------------------------<br />';

                    echo 'Year - ' . $section->year;

                    echo '<br />-----------------------------------<br />';

                    for($j=1;$j<=$ExamAmount;$j++){

                        if($tempExamDay == ($exam_start_day/1)){
                            $real = mktime($hour,$min,$second,$month,$tempExamDay,$year);
                            if(date("l", $real ) == "Saturday" || date("l", $real ) =="Sunday"){

                            }else{
                                echo $j.'-Day '.date("l", $real ).$exam_day_counter . '<br />';

                                $finalExam = FinalExam::create([
                                    'flag' => true ,
                                    'course_id' => 1,
                                    'invigilator_1'=> '',
                                    'session'=> '',
                                    'room' => '',
                                    'block'=> '',
                                    'exam_date'=> date("F jS", $real),
                                    'day'=> date("l", $real),
                                    'course_title'=> '',
                                    'course_code'=> '',
                                    'class_id'=> $section->id,
                                    'college_id'=> $college_id,
                                    'department_id'=> $department_id,
                                    'class_name'=> $section->class_name,
                                    'invigilator_2'=> '',
                                    'college_name' => $college_name,
                                    'year'=> $section->year

                            ]);




                                $tempExamDay+=$ExamDaySpace;
                            }

                        }else{
                            $real = mktime($hour,$min,$second,$month,$tempExamDay,$year);

                            if(date("l", $real ) == "Saturday" ||  date("l", $real ) == "Sunday"){
                                $tempExamDay+=1;
                                //echo $j. '- Day '.date("l", $real ) .  $tempExamDay . '<br />';

                                $real = mktime($hour,$min,$second,$month,$tempExamDay,$year);
                                if(date("l", $real ) =="Sunday"){
                                    $tempExamDay+=1;
                                    $real = mktime($hour,$min,$second,$month,$tempExamDay,$year);

                                    echo $j. '- Day '.date("l", $real ) .  $tempExamDay . '<br />';

                                    $finalExam = FinalExam::create([
                                        'flag' => true ,
                                        'course_id' => 1,
                                        'invigilator_1'=> '',
                                        'session'=> '',
                                        'room' => '',
                                        'block'=> '',
                                        'exam_date'=> date("F jS", $real),
                                        'day'=> date("l", $real),
                                        'course_title'=> '',
                                        'course_code'=> '',
                                        'class_id'=> $section->id,
                                        'college_id'=> $college_id,
                                        'department_id'=> $department_id,
                                        'class_name'=> $section->class_name,
                                        'invigilator_2'=> '',
                                        'college_name' => $college_name,
                                        'year'=> $section->year

                                ]);
                                $tempExamDay+=$ExamDaySpace;
                                }else{
                                    $real = mktime($hour,$min,$second,$month,$tempExamDay,$year);

                                    echo $j. '- Day '.date("l", $real ) .  $tempExamDay . '<br />';

                                    $finalExam = FinalExam::create([
                                        'flag' => true ,
                                        'course_id' => 1,
                                        'invigilator_1'=> '',
                                        'session'=> '',
                                        'room' => '',
                                        'block'=> '',
                                        'exam_date'=> date("F jS", $real),
                                        'day'=> date("l", $real),
                                        'course_title'=> '',
                                        'course_code'=> '',
                                        'class_id'=> $section->id,
                                        'college_id'=> $college_id,
                                        'department_id'=> $department_id,
                                        'class_name'=> $section->class_name,
                                        'invigilator_2'=> '',
                                        'college_name' => $college_name,
                                        'year'=> $section->year

                                ]);
                                $tempExamDay+=$ExamDaySpace;

                                }

                            }else{

                                echo $j. '- Day '.date("l", $real ) .  $tempExamDay . '<br />';

                                    $finalExam = FinalExam::create([
                                        'flag' => true ,
                                        'course_id' => 1,
                                        'invigilator_1'=> '',
                                        'session'=> '',
                                        'room' => '',
                                        'block'=> '',
                                        'exam_date'=> date("F jS", $real),
                                        'day'=> date("l", $real),
                                        'course_title'=> '',
                                        'course_code'=> '',
                                        'class_id'=> $section->id,
                                        'college_id'=> $college_id,
                                        'department_id'=> $department_id,
                                        'class_name'=> $section->class_name,
                                        'invigilator_2'=> '',
                                        'college_name' => $college_name,
                                        'year'=> $section->year

                                ]);




                                $tempExamDay+=$ExamDaySpace;
                            }

                        }

                    }
                    break;

                    echo '<br />';









            }

              //echo "DAY - " . $exam_day_counter . '<br />';
              $exam_day_counter++;
            }
        }else{
            //echo "Already Exists ". 'Year - '.$section->year. ' Section -'.$section->class_name . ' - <br /> ';







        }


    }


    foreach ($EverySection as $sections) {

        $finalExamRow = FinalExam::where('class_id',$sections->id)
                                    ->where('class_name',$sections->class_name)
                                    ->get();


        echo "<br />Each Section Exam Amount where class_id ". $sections->id.' count=' .   $finalExamRow->count() . '<br />';

        foreach ($finalExamRow as $row) {
                echo "<br />FinalExam Row ".$row->class_id . '<br />';

                $Examcourses = ExamCourses::where('course_year', $sections->year)
                                    ->where('department_id', $sections->department_id)
                                    ->where('semester', $sections->semester)
                                    ->get();

                echo $Examcourses->count();
                $counter = 0;
                foreach ($Examcourses as $key => $course) {

                    echo $counter++;

                    $mainCourse = Course::find($course->course_id);
                    if($row->where('course_title',$mainCourse->course_title)->where('class_id',$sections->id)->get()->count() > 0){
                         continue;  //if found assigned it will jump
                    }else{
                        $row->update([
                            'course_id' => $mainCourse->id,
                            'course_code' => $mainCourse->course_code,
                            'course_title' => $mainCourse->course_title,

                        ]);
                    }

                    //handle common course


                }






        }

    }





}

}




/**
 *
 *
 *
 */
