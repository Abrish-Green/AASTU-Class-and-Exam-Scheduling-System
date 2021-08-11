<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class College extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function departments(){
        return $this->hasMany(\App\Models\Department::class);
    }
}
