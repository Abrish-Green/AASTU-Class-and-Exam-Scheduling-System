<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'department_id',
        'course_year',
        'year',
        'semester',
    ];

    public function courses(){
        return $this->belongsTo(\App\Models\Course::class);
    }
}
