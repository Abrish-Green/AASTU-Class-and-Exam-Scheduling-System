<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semster extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_name',
    ];

    public function year(){
        return $this->belongsTo(\App\Models\Year::class);
    }
    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
}
