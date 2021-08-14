<?php

namespace App\Http\Controllers\api\privates\placement;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Classes;
use App\Models\Room;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class PlacementController extends Controller
{
    //


    public function addBlock(Request $request){ //college
        $block = Block::create([
            'name' => $request->name,
        ]);

        return response([
            'CREATED_DATA' =>$block,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function addRoom(Request $request){  //college

        $room = Room::create([
            'room_name' => $request->room_name,
            'block_id' => $request->block_id,
        ]);
        return response([
            'CREATED_DATA' =>$room,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }

    public function GenerateRoomsForBlock(Request $request){  //college

        $floors = $request->floor;
        $rooms_per_floor = $request->rooms_per_floor;
        $rooms = array();
        //$block = (Block::findOrFail($request->block_id)) ? Block::findOrFail($request->block_id)->name : '!Block';
        $total_rooms = $floors*$rooms_per_floor;

        for($room=0;$room<$total_rooms;$room++){

                $tempRoom = Room::create([
                    'room_name' => $room ,
                ]);
                array_push( $rooms, $tempRoom);
        }
        return response([
            'CREATED_DATA' =>$rooms,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
    public function addClass(Request $request){
        $classes = Classes::create([
            'class_name' => $request->name,
            'entry_year' => $request->entry_year,
            'semester' => $request->semester,
            'department_id' =>$request->department_id,
        ],200);

        return response([
            'CREATED_DATA' =>$classes,
            'Message' => 'Successful',
            'Status' => 'OK'
        ],200);
    }
}
