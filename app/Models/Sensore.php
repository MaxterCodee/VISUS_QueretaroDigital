<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensore extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo_sensor_id', 'reserva_id'];

    public function tipoSensor()
    {
        return $this->belongsTo(TipoSensor::class, 'tipo_sensor_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function dato()
    {
        return $this->hasMany(Dato::class);
    }

    public function predicciones()
    {
        return $this->hasMany(Prediccione::class);
    }

}
