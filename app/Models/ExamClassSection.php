<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamClassSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'department_id',
        'year'
    ];

    public function section(){
        return $this->hasMany(\App\Models\ExamClassSection::class);
    }
}
