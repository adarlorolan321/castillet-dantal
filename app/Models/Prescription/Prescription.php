<?php

namespace App\Models\Prescription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id","medecine_id","quantity","description","history_id"
    ];
}
