<?php

namespace App\Http\Controllers\api\priVates\section;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ExamClassSection;
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

            //check if is done before

            $check = classes::where([
                'department_id'=> $request->department_id,
                'year'=> $request->year
                ]
                )->get();

            if($check->count() > 0){
                return response([
                    'check' => $check,
                    'Error' =>  'Section Already Created',
                    'Message' => 'UnSuccessful',
                    'Status' => 'OK'
                ],200);
            }


            for($i=1;$i<=$amount;$i++){
                $college_block = Classes::create([
                    'class_name' => 'Section ' . $i,
                    'year' => $request->year,
                    'semester' => 1,
                    'department_id' => $request->department_id,
                    ]);

                array_push($sections,$college_block);
            }

            return response([
                'college_block' =>  $sections,
                'Message' => 'Successful',
                'Status' => 'OK',
                'Error' => null
            ],200);
       }catch(Exception $e){
           return response([
               'Message' => 'UnSuccessful',
               'Status' => 'OK',
               'Error'=> $e
           ],200);
       }

    }
    public function create_exam_section(Request $request)
    {
        //
        try{

            $amount = $request->amount;
            $sections = array();

            //check if is done before

            $check = ExamClassSection::where([
                'department_id'=> $request->department_id,
                'year'=> $request->year
                ]
                )->get();

            if($check->count() > 0){
                return response([
                    'check' => $check,
                    'Error' =>  'Section Already Created',
                    'Message' => 'UnSuccessful',
                    'Status' => 'OK'
                ],200);
            }


            for($i=1;$i<=$amount;$i++){
                $college_block = ExamClassSection::create([
                    'class_name' => 'Section ' . $i,
                    'year' => $request->year,
                    'semester' => 1,
                    'department_id' => $request->department_id,
                    ]);

                array_push($sections,$college_block);
            }

            return response([
                'college_block' =>  $sections,
                'Message' => 'Successful',
                'Status' => 'OK',
                'Error' => null
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
    public function getAllSection(Request $request)
    {
        //
        $sections = Classes::where('department_id', $request->department_id)->get();

        if($sections->count() == 0){
            return response([
                'check' => $sections,
                'Error' =>  'Section Already Created',
                'Message' => 'UnSuccessful',
                'Status' => 'OK'
            ],200);
        }

        return response([
            'sections' =>  $sections,
            'Message' => 'Successful',
            'Status' => 'OK',
            'Error' => null
        ],200);

    }

    public function getAllExamSection(Request $request)
    {
        //
        $sections = ExamClassSection::where('department_id', $request->department_id)->get();

        if($sections->count() == 0){
            return response([
                'check' => $sections,
                'Error' =>  'Section Already Created',
                'Message' => 'UnSuccessful',
                'Status' => 'OK'
            ],200);
        }

        return response([
            'sections' =>  $sections,
            'Message' => 'Successful',
            'Status' => 'OK',
            'Error' => null
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteClasses(Request $request)
    {
        //
        $class = Classes::where([
            'department_id' => $request->department_id,
            'year' => $request->year
            ]);

            if($class->get()->count() > 0){
                $class->delete();
                return response([
                    'Message' => 'Successful',
                    'Status' => 'OK',
                    'Error' => null
                ],200);
            }
            return response([
                'Message' => 'UnSuccessful',
                'Status' => 'OK',
                'Error' => true
            ],200);


    }
    public function deleteExamClasses(Request $request)
    {
        //
        $class = ExamClassSection::where([
            'department_id' => $request->department_id,
            'year' => $request->year
            ]);

            if($class->get()->count() > 0){
                $class->delete();
                return response([
                    'Message' => 'Successful',
                    'Status' => 'OK',
                    'Error' => null
                ],200);
            }
            return response([
                'Message' => 'UnSuccessful',
                'Status' => 'OK',
                'Error' => true
            ],200);


    }
}
