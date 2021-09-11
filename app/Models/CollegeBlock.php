<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeBlock extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_name',
        'block_id',
        'college_id'
    ];


    public function block(){
        return $this->belongsTo(\App\Models\Block::class,'block_id');
    }
    public function college(){
        return $this->belongsTo(\App\Models\Block::class,'college_id');
    }
}
