<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_title',
        'course_code',
        'invigilators',
        'exam_date',
        'exam_day_name',
        'year',
        'section_id',
        'exam_room'
    ];
}
