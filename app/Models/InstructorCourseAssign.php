<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorCourseAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'instructor_name',
        'course_id',
        'year',
        'semester',
        'department_id'
];
}
