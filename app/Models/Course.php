<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_title',
        'course_name',
        'course_credit_hour',
        'course_has_lab',
        'course_type',
        'course_department_id',
    ];

    public function instructor(){
        return $this->hasMany(\App\Models\Instructor::class);
    }
    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
    public function room(){
        return $this->hasMany(\App\Models\Room::class);
    }
    public function semester(){
        return $this->belongsTo(\App\Models\Semester::class);

    }
    public function year(){
        return $this->belongsTo(\App\Models\Year::class);
    }
    public function department(){
        return $this->belongsTo(\App\Models\Department::class);
    }
    public function timeslot(){
        return $this->hasMany(\App\Models\timeslot::class);
    }
    public function day(){
        return $this->hasMany(\App\Models\Day::class);
    }
}
