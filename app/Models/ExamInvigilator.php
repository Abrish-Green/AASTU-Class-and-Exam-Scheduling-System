<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInvigilator extends Model
{
    use HasFactory;

    protected $fillable = [
        'invigilator_name',
        'active',
        'department_id'
    ];
}
