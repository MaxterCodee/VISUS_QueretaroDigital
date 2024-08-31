<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediccione extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_predicho',
        'exactitud',
        'sensore_id',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensore::class);
    }
}
