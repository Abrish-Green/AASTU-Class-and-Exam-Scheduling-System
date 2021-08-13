<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'catagory_name',
    ];

    public function course(){
        return $this->belongsTo(\App\Models\Course::class);
    }
}
