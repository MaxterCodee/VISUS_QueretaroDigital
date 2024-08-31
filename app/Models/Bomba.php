<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bomba extends Model
{
    use HasFactory;


    protected $fillable = [
        'horas_limite',
        'horas_actuales',
    ];
}
