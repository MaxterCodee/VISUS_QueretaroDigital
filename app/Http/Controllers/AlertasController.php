<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Reserva;
use App\Models\TipoSensor;
use App\Models\Sensore;
use Illuminate\Http\Request;

class AlertasController extends Controller

{
    public function index()
    {
        $lastdata = $this->ultimoDato();
        $alertas = $this->alertas($lastdata);

        return view('dashboard', compact('alertas'));
    }

    private function ultimoDato()
    {
        $reservas = Reserva::with(['sensores.tipoSensor', 'sensores.datos' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Ordena los datos por 'created_at' en orden descendente
        }])->get();

        $lastdata = [];

        foreach ($reservas as $reserva) {
            foreach ($reserva->sensores->groupBy('tipoSensor.id') as $tipoId => $sensores) {
                $sensor = $sensores->first();

                // Obtiene el primer dato de la colección ordenada
                $lastDato = $sensor->datos->first();

                if ($lastDato) {
                    $lastdata[$reserva->nombre][$sensor->tipoSensor->nombre] = $lastDato;
                } else {
                    $lastdata[$reserva->nombre][$sensor->tipoSensor->nombre] = null; // O un valor por defecto
                }
            }
        }
       
        return $lastdata;
    }

    private function alertas($lastdata)
    {
        $alertas = [];
        foreach ($lastdata as $reserva => $sensores) {
            foreach ($sensores as $tipo => $dato) {
                if ($dato) {
                    $tipoSensor = TipoSensor::where('nombre', $tipo)->first();
                    $sensor = Sensore::where('tipo_sensor_id', $tipoSensor->id)->first();
                    $reserva = Reserva::where('id', $sensor->reserva_id)->first();
                    $dato = Dato::where('sensore_id', $sensor->id)->orderBy('created_at', 'desc')->first();
    
                    if ($dato->valor > $tipoSensor->max_val) {
                        $alertas[] = [
                            'reserva' => $reserva->nombre,
                            'sensor' => $sensor->nombre,
                            'tipo' => $tipoSensor->nombre,
                            'valor' => $dato->valor,
                            'mensaje' => 'Valor por encima del máximo',
                        ];
                    } elseif ($dato->valor < $tipoSensor->min_val) {
                        $alertas[] = [
                            'reserva' => $reserva->nombre,
                            'sensor' => $sensor->nombre,
                            'tipo' => $tipoSensor->nombre,
                            'valor' => $dato->valor,
                            'mensaje' => 'Valor por debajo del mínimo',
                        ];
                    }
                }
            }
        }
    
        return $alertas;
    }
    
}
