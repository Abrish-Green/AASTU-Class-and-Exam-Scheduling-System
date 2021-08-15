<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_name',
    ];

    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
    public function college(){
        return $this->belongsTo(\App\Models\College::class);
    }
    public function department(){
        return $this->belongsTo(\App\Models\Department::class);
    }
    public function rooms(){
        return $this->hasMany(\App\Models\Room::class);
    }


}
