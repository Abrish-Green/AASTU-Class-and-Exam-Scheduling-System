<?php

namespace App\Http\Controllers\api\privates\placement;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\ClassBlockRoom;
use App\Models\Classes;
use App\Models\CollegeBlock;
use App\Models\CollegeBlockRooms;
use App\Models\CustomRoom;
use App\Models\LabRoom;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;

class PlacementController extends Controller
{
    //
    public function addBlock(Request $request){ //department
        $block = Block::create([
            'block_name' => $request->block_name,
        ]);

        return response([
            'CREATED_DATA' =>$block,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function deleteBlock($id){ //department

        try{
             Block::findOrFail($id)->delete();

            return response([
                'Message' => 'Successful',
                'Status' => 'OK'
            ],200);

        }catch(Exception $e){
            return response([
                'Message' => 'Successful',
                'Status' => 'OK',
                'Error'=> $e
            ],200);
        }

    }
    public function useBlock(Request $request){ //department
        try{

            $check = CollegeBlock::where('block_id', $request->block_id)->get()->count();
            if($check > 0){
                return response([
                    'Message' => 'Block Already exists',
                    'Status' => 'OK'
                ],200);

            }
             $college_block = CollegeBlock::create([
                'block_name' => $request->block_name,
                'block_id' => $request->block_id,
                'college_id' => $request->college_id
                ]);

            return response([
                'college_block' =>  $college_block,
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


    public function create_class_block_room(Request $request){


        try{

        $ClassBlockRoom = ClassBlockRoom::create([
                            'room' => $request->room,
                            'block'=>$request->block,
                            'year' =>$request->year,
                            'department_id' =>$request->department_id
        ]);

        return response([
            'block_room' => $ClassBlockRoom
        ],200);

    }catch(Exception $e){
        return response([
            'error' => $e
        ]);
    }
}




    public function AddedClassRooms(Request $request){
        //
        $ExamRoom = ClassBlockRoom::where('department_id',$request->department_id)
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





    public function useRooms(Request $request){ //department
        try{

            $check = CollegeBlockRooms::where('block_id', $request->block_id)->get()->count();

             $college_block = CollegeBlock::create([
                'block_name' => $request->block_name,
                'block_id' => $request->block_id,
                'college_id' => $request->college_id
                ]);

            return response([
                'college_block' =>  $college_block,
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

    public function usedBlock(Request $request){ //department
        try{
             $college_block = CollegeBlock::where('college_id', $request->college_id)->get();

            return response([
                'college_block' =>  $college_block,
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


    public function getMyBlock(Request $request){
        $getmyblock = CollegeBlock::where('college_id',$request->college_id)->get();
        return response([
            'block' => $getmyblock,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }


    public function getBlockById($id){
        $block = Block::find($id)->get();

        return response([
            'block' => $block,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function index(Request $request){ //department
        $block = Block::all();

        return response([
            'block' =>$block,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addRoom(Request $request){  //department

        $room = Room::create([
            'rooms_name' => $request->room_name,
        ]);
        return response([
            'CREATED_DATA' =>$room,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function GenerateRoomsForBlock(Request $request){  //

        $floors = $request->floor;
        $rooms_per_floor = $request->rooms_per_floor;
        $rooms = array();
        //$block = (Block::findOrFail($request->block_id)) ? Block::findOrFail($request->block_id)->name : '!Block';
        $total_rooms = $floors*$rooms_per_floor;

        for($room=1;$room<=$total_rooms;$room++){

                $tempRoom = Room::create([
                    'rooms_name' => $room ,
                ]);
                array_push( $rooms, $tempRoom);
        }
        return response([
            'CREATED_DATA' =>$rooms,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function addClass(Request $request){ //department
        $classes = Classes::create([
            'class_name' => $request->name,
            'year' => $request->year,
            'semester' => $request->semester,
            'department_id' =>$request->department_id,
        ],200);

        return response([
            'CREATED_DATA' =>$classes,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function addLab(Request $request){ //department
        $lab = LabRoom::create([
            'lab_name' => $request->name,
            'department_id' => $request->department_id
        ],200);

        return response([
            'CREATED_DATA' =>$lab,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function addCustomRoom(Request $request){ //department
        $customRoom = CustomRoom::create([
            'custom_name' => $request->name,
            'department_id' => $request->department_id
        ],200);

        return response([
            'CREATED_DATA' =>$customRoom,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
}
