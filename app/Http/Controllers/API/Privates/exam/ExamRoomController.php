<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
use App\Models\ExamBlockRoom;
use App\Models\ExamPlacement;
use Illuminate\Http\Request;

class ExamRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ExamRoom = ExamPlacement::all();

        return response([
            'CREATED_DATA' =>$ExamRoom,
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
            'room' =>'required',
            'block'=>'required',
            'year'=>'required',
            'department_id'=>'required'
        ]);

        $ExamRoom = ExamBlockRoom::create([
            'room' => $Validated['room'],
            'block' =>$Validated['block'],
            'year' =>$Validated['year'],
            'department_id' =>$Validated['department_id']
        ]);

        return response([
            'room' =>$ExamRoom,
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
    public function getMyExamRooms(Request $request)
    {
        //
        $ExamRoom = ExamBlockRoom::where('department_id',$request->department_id)
                                  ->get();

        if(!$ExamRoom){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'room' =>$ExamRoom,
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
        $ExamRoom = ExamPlacement::findOrFail($id);

        if(!$ExamRoom){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }

        $ExamRoom->update($request->all());
        $Updated = ExamPlacement::findOrFail($id);

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
        $ExamCourse = ExamPlacement::findOrFail($id);
        if(!$ExamCourse){
            return response([
                'Message' => 'Exam Course Not Found',
                'Status' => 'OK'
            ],400);
        }
        ExamPlacement::findOrFail($id)->delete();
        return response([
            'Message'=>'Exam Course Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }
}
