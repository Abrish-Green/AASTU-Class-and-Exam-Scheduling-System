<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_start_time',
    ];

    public function exam_time(){
        return $this->belongsTo(\App\Models\ExamSchedule::class);
    }

}
