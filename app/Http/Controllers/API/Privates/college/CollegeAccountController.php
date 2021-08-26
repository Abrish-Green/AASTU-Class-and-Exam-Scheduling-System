<?php

namespace App\Http\Controllers\API\Privates\college;

use App\Http\Controllers\Controller;
use App\Models\College;
use Illuminate\Http\Request;

class CollegeAccountController extends Controller
{

    public function index()
    {
        $colleges = College::all();
        return response([
            'college' => $colleges
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
            'name' => 'required',
        ]);

        $college = College::create([
            'name' => $Validated['name'],
        ]);
        return response([
            'DATA' =>  $college,
            'Message'=>'College Successfully Created',
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
        $college = College::findOrFail($id);
        if(!$college){
            return response([
                'Message' => 'College Not Found',
                'Status' => 'OK'
            ],401);
        }

        return response([
            'college' => $college,
            'Message' => 'College Found',
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
        $Validated = $request->validate([
            'name' => 'required',
        ]);

        $college = College::findOrFail($id)->update($request->all());
        return response([
            'Updated' => $college,
            'Message'=>'College Successfully Updated',
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
        $college = College::findOrFail($id);
        if(!$college){
            return response([
                'Message' => 'College Not Found',
                'Status' => 'OK'
            ],200);
        }
        College::findOrFail($id)->delete();
        return response([
            'Message'=>'College Successfully Deleted',
            'Status' => 'OK'
        ],200);
    }

}
