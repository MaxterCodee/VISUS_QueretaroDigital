<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'sensor_id',
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensore::class);
    }
}