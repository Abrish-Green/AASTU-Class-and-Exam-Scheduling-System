<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'Year_name',
    ];

    public function semester(){
        return $this->hasMany(\App\Models\Semester::class);
    }
}
