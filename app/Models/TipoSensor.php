<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'max_val',
        'min_val',
        'unidad',
    ];

    public function sensores()
    {
        return $this->hasMany(Sensore::class);
    }
}
