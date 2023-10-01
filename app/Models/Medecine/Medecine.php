<?php

namespace App\Models\Medecine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecine extends Model
{
    use HasFactory;

    protected $fillable = [
        "name","description","price","quantity","unit",
    ];
    
}
