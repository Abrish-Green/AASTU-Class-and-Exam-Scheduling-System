<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block_To_Room extends Model
{
    use HasFactory;


    protected $fillable = [
        'room_id',
        'block_id'

    ];

    public function block(){
        return $this->belongsTo(\App\Models\Block::class);
    }
    public function classes(){
        return $this->belongsTo(\App\Models\Classes::class);
    }
}
