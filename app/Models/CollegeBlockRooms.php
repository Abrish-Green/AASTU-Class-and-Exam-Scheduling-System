<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeBlockRooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'room_id',
        'college_id',
    ];
}
