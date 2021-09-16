<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [

        'class_id',
        'course_id',
        'course_code',
        'course_title',
        'course_credit_hour',
        'session',
        'room',
        'block',
        'day',
        'class_name',
        'semester',
        'year',
        'has_lab',
        'lab_name',
        'lab_id',
        'instructor',
        'instructor_id',
        'department_name',
        'etw',
        'college_name',
        'department_id',
        'college_id'
    ];
}
