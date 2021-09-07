<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamClassSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'year',
        'semester',
        'department_id',
    ];

    public function section(){
        return $this->hasMany(\App\Models\ExamClassSection::class);
    }
}
