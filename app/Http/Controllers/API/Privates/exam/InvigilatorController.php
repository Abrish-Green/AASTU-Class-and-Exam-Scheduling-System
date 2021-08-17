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
    public function index()
    {
        //
        $ExamInvigilator = ExamInvigilator::all();
        return response([
            'CREATED_DATA' =>$ExamInvigilator,
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
            'invigilator_name' => $request->invigilator_name,
            'active' => $request->active
        ]);

        $ExamInvigilator = ExamInvigilator::create([
            'invigilator_name' => $Validated['invigilator_name'],
            'active' =>$Validated['active'],
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
