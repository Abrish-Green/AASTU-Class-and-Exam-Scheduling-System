<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorToClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'instructor_to_course_id'
    ];

    public function instructor(){
        return $this->hasMany(\App\Models\Course::class);
    }
    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
    public function course(){
        return $this->hasMany(\App\Models\Instructor::class);
    }
}
