<?php

namespace App\Http\Controllers\api\privates\exam;

use App\Http\Controllers\Controller;
use App\Models\ExamInvigilator;
use Illuminate\Http\Request;

class InvigilatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMyInvigilators(Request $request)
    {
        //
        $ExamInvigilator = ExamInvigilator::where('department_id', $request->department_id)->get();
        return response([
            'invigilators' =>$ExamInvigilator,
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
    public function AddInvigilator(Request $request)
    {
        //
        $Validated = $request->validate([
            'invigilator_name' => 'required',
            'department_id'=> 'required'
        ]);

        $ExamInvigilator = ExamInvigilator::create([
            'invigilator_name' => $Validated['invigilator_name'],
            'active' => 1,
            'department_id'=>$Validated['department_id']
        ]);

        return response([
            'CREATED_DATA' =>$ExamInvigilator,
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
        $ExamInvigilator = ExamInvigilator::findOrFail($id);

        if(!$ExamInvigilator){
            return response([
                'Message' => 'Invigilator Not Found',
                'Status' => 'OK'
            ],200);
        }
        return response([
            'CREATED_DATA' =>$ExamInvigilator,
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
        $ExamInvigilator = ExamInvigilator::findOrFail($id);

        if(!$ExamInvigilator){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],400);
        }

        $ExamInvigilator->update($request->all());

        return response([
            'CREATED_DATA' =>$ExamInvigilator,
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
        $ExamInvigilator = ExamInvigilator::findOrFail($id);

        if(!$ExamInvigilator){
            return response([
                'Message' => 'Not Found',
                'Status' => 'OK'
            ],400);
        }

        $ExamInvigilator->delete();

        return response([
            'Message' => 'Deleted Successfully',
            'Status' => 'OK'
        ],200);
    }
}
