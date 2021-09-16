<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamBlockRoom extends Model
{
    use HasFactory;

    protected $fillable = [
            'room',
            'block',
            'year',
            'department_id'
    ];

}

