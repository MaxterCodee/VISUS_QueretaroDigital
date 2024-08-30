<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoReserva extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];


    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
