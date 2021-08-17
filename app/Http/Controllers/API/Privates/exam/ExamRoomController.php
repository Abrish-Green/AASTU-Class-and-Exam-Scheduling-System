<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
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
            'section_id' =>'required',
            'block_id'=>'required',
            'room_id'=>'required'
        ]);

        $ExamRoom = ExamPlacement::create([
            'section_id' => $Validated['section_id'],
            'block_id' =>$Validated['block_id'],
            'room_id' =>$Validated['room_id'],
        ]);

        return response([
            'CREATED_DATA' =>$ExamRoom,
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
        $ExamRoom = ExamPlacement::findOrFail($id);

        if(!$ExamRoom){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'CREATED_DATA' =>$ExamRoom,
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
