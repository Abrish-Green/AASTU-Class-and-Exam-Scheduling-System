<?php

namespace App\Http\Controllers\api\priVates\section;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{

            $amount = $request->amount;
            $sections = array();
            for($i=1;$i<=$amount;$i++){
                $college_block = Classes::create([
                    'class_name' => 'Section ' . $i,
                    'year' => $request->year,
                    'semester' => $request->semester,
                    'department_id' => $request->department_id,
                    ]);

                array_push($section,$college_block);
            }

            return response([
                'college_block' =>  $sections,
                'Message' => 'Successful',
                'Status' => 'OK'
            ],200);
       }catch(Exception $e){
           return response([
               'Message' => 'UnSuccessful',
               'Status' => 'OK',
               'Error'=> $e
           ],200);
       }

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
    }
}
