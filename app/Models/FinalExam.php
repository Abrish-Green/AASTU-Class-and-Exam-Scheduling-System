<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'flag',
        'course_id',
        'invigilator_1',
        'session',
        'room',
        'block',
        'exam_date',
        'day',
        'course_title',
        'course_code',
        'class_id',
        'college_id',
        'department_id',
        'class_name',
        'invigilator_2',
        'college_name',
        'year'

    ];

}
