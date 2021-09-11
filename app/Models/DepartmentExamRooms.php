<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentExamRooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'block_id',
        'department_id'
    ];
}
