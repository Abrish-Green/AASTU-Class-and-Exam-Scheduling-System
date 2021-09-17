<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassBlockRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room',
        'block',
        'year',
        'department_id'
];
}
