<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_name',
    ];

    public function timeslot(){
        return $this->belongsTo(\App\Models\Timeslot::class);
    }
}
