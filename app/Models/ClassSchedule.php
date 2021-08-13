<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'year_id',
        'semester_id',
        'day_id',
    ];

    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }

    public function Year(){
        return $this->belongsTo(\App\Models\Year::class);
    }

    public function day(){
        return $this->hasMany(\App\Models\Day::class);
    }

    public function timeslot(){
        return $this->hasMany(\App\Models\timeslot::class);
    }

    public function timeslot_data(){
        return $this->hasMany(\App\Models\TimeslotData::class);
    }

    public function semester(){
        return $this->belongsTo(\App\Models\Semester::class);
    }

    public function room(){
        return $this->hasMany(\App\Models\Room::class);
    }

    public function instructor(){
        return $this->hasMany(\App\Models\Instructor::class);
    }

}
