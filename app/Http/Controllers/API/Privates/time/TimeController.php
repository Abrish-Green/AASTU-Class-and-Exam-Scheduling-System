<?php

namespace App\Http\Controllers\api\privates\time;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Semster;
use App\Models\Timeslot;
use App\Models\TimeSlotData;
use App\Models\Year;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    //
    public function addYear(Request $request){
        $year = Year::create([
            'Year_name'=> $request->year_name
        ]);
        return response([
            'CREATED_DATA' => $year,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addSemester(Request $request){
        $semester = Semster::create([
            'semester'=> $request->semester_name
        ]);
        return response([
            'CREATED_DATA' =>$semester,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addDay(Request $request){
        $day = Day::create([
            'day_name'=> $request->day_name
        ]);
        return response([
            'CREATED_DATA' =>$day,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addTimeslot(Request $request){
        $timeslot = Timeslot::create([
            'session_name' => $request->session_name,
            'session_start_time' => $request->session_start_time,
            'session_end_time' =>$request->session_end_time
        ]);
        return response([
            'CREATED_DATA' => $timeslot,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addTimeslotData(Request $request){
        $timeslotData = TimeSlotData::create([
            'time_slot_id' => $request->time_slot_id,
            'room_id' =>  $request->room_id,
            'course_id' =>  $request->course_id,
            'instructor_id' =>  $request->instructor_id,
        ]);
        return response([
            'CREATED_DATA' =>$timeslotData,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

}
