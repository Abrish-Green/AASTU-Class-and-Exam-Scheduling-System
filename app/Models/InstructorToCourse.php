<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorToCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'instructor_id',
        'course_id'
    ];

    public function instructor(){
        return $this->hasMany(\App\Models\Course::class);
    }
    public function department(){
        return $this->hasMany(\App\Models\Department::class);
    }
    public function course(){
        return $this->hasMany(\App\Models\Instructor::class);
    }
}
