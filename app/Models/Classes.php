<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'year',
        'semester',
        'department_id',
    ];

    public function semester(){
        return $this->belongsTo(\App\Models\Semester::class);
    }

    public function room(){
        return $this->hasMany(\App\Models\Room::class);
    }

    public function timeslot(){
        return $this->hasMany(\App\Models\timeslot::class);
    }

    public function department(){
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function college(){
        return $this->belongsTo(\App\Models\College::class);
    }

    public function instructor(){
        return $this->hasMany(\App\Models\Instructor::class);
    }

    public function day(){
        return $this->hasMany(\App\Models\Day::class);
    }

    public function course(){
        return $this->hasMany(\App\Models\Course::class);
    }
}
