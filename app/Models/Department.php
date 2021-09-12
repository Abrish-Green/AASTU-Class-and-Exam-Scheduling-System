<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'college_id'
    ];

    public function colleges(){
        return $this->belongsTo(\App\Models\College::class,'college_id');
    }
    public function instructors(){
        return $this->hasMany(\App\Models\Instructor::class);
    }
}
