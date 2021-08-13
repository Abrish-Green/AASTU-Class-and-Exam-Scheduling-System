<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'block_id',
    ];

    public function block(){
        return $this->belongsTo(\App\Models\Block::class);
    }
    public function classes(){
        return $this->hasMany(\App\Models\Classes::class);
    }
    public function timeslot(){
        return $this->hasMany(\App\Models\Timeslot::class);
    }
}
