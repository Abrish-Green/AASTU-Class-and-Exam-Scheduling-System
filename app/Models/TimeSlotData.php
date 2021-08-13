<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlotData extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_slot_id',
        'room_id',
        'course_id',
        'instructor_id',
    ];
    public function timeslot(){
        return $this->belongsTo(\App\Models\Timeslot::class);
    }

    public function room(){
        return $this->hasMany(\App\Models\Room::class);
    }
    public function course(){
        return $this->hasMany(\App\Models\Course::class);
    }
    public function instructor(){
        return $this->hasMany(\App\Models\Instructor::class);
    }
}
