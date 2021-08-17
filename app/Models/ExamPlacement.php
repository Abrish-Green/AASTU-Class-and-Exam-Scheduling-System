<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'block_id',
        'room_id'
    ];

    public function section(){
        return $this->hasMany(\App\Models\ExamClassSection::class);
    }
    public function block(){
        return $this->hasMany(\App\Models\Block::class);
    }
    public function room(){
        return $this->hasMany(\App\Models\Room::class);
    }

}
