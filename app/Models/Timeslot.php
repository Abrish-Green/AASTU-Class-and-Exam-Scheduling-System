<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_name',
        'session_start_time',
        'session_end_time'
    ];

    public function day(){
        return $this->belongsTo(\App\Models\Day::class);
    }
    public function time_slot_data(){
        return $this->hasMany(\App\Models\TimeslotData::class);
    }
    public function classes(){
        return $this->belongsTo(\App\Models\Classes::class);
    }

}
