<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddAndDropStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_department_id',
        'student_year',
        'adding_course',
        'adding_in_department_id',
        'adding_class_year',
        'adding_class_id',
    ];

    public function department(){
        return $this->hasMany(\App\Models\Department::class);
    }
    public function course(){
        return $this->hasMany(\App\Models\Course::class);
    }
    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
}
