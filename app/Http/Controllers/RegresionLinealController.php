<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use Phpml\Regression\LinearRegression;
use Phpml\Dataset\ArrayDataset;

use Illuminate\Http\Request;
use Phpml\FeatureSelection\ScoringFunction\UnivariateLinearRegression;
use Phpml\Regression\LeastSquares;

class RegresionLinealController extends Controller
{
    public function realizarRegresionLineal()
    {
        // 1. Recuperar los datos necesarios de la base de datos
        $datos = Dato::with('sensor.tipoSensor', 'sensor.reserva')->get();

        // Verificar si hay registros
        if ($datos->isEmpty()) {
            return response()->json([
                'mensaje' => 'No hay registros'
            ], 404); // Puedes elegir el código de estado adecuado
        }

        // 2. Preparar los datos para la regresión lineal
        // Variables independientes (tipo_sensor_id, reserva_id)
        $samples = $datos->map(function ($dato) {
            return [
                $dato->sensor->tipo_sensor_id, // Tipo de sensor como una variable independiente
                $dato->sensor->reserva_id, // Reserva como otra variable independiente
            ];
        })->toArray();

        // Variable dependiente (valor del dato)
        $targets = $datos->pluck('valor')->toArray();

        // 3. Crear y entrenar el modelo de regresión lineal
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // 4. Realizar una predicción
        // Ejemplo: predecir el valor del sensor con tipo_sensor_id = 2 y reserva_id = 5
        $prediccion = $regression->predict([2, 5]);

        // 5. Mostrar los resultados
        return response()->json([
            'prediccion' => $prediccion,
        ]);
    }




    //
    // public function realizarRegresionLineal()
    // {
    //     // 1. Recuperar los datos necesarios de la base de datos
    //     $datos = Dato::with('sensor.tipoSensor', 'sensor.reserva')->get();

    //     // 2. Preparar los datos para la regresión lineal
    //     // Variables independientes (tipo_sensor_id, reserva_id)
    //     $samples = $datos->map(function ($dato) {
    //         return [
    //             $dato->sensor->tipo_sensor_id, // Tipo de sensor como una variable independiente
    //             $dato->sensor->reserva_id, // Reserva como otra variable independiente
    //         ];
    //     })->toArray();

    //     // Variable dependiente (valor del dato)
    //     $targets = $datos->pluck('valor')->toArray();

    //     // 3. Crear y entrenar el modelo de regresión lineal
    //     $regression = new LeastSquares();
    //     $regression->train($samples, $targets);

    //     // 4. Realizar una predicción
    //     // Ejemplo: predecir el valor del sensor con tipo_sensor_id = 2 y reserva_id = 5
    //     $prediccion = $regression->predict([2, 5]);

    //     // 5. Mostrar los resultados
    //     return response()->json([
    //         'prediccion' => $prediccion,
    //     ]);
    // }
}
