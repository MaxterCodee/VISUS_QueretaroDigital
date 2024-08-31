<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'coordenadas', 'tipo_reserva_id'];

    public function tipos()
    {
        return $this->belongsTo(TipoReserva::class, 'tipo_reserva_id');
    }

    public function sensores()
    {
        return $this->hasMany(Sensore::class, 'reserva_id');
    }
}
