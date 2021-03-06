<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'link_to',
        'active',
        'remember_token',
        'department_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function department(){
        return $this->belongsTo(\App\Models\Department::class);
    }


}
