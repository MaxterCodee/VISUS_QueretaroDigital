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
            ], 404);
        }

        // 2. Agrupar datos por 'reserva_id'
        $agrupadosPorReserva = $datos->groupBy('sensor.reserva_id');

        // 3. Inicializar array para almacenar predicciones por 'reserva_id'
        $resultados = [];

        // 4. Realizar la regresión lineal para cada grupo de 'reserva_id'
        foreach ($agrupadosPorReserva as $reservaId => $grupo) {
            // Preparar los datos para la regresión lineal por cada reserva
            $samples = $grupo->map(function ($dato) {
                return [
                    $dato->sensor->tipo_sensor_id, // Tipo de sensor como variable independiente
                ];
            })->toArray();

            $targets = $grupo->pluck('valor')->toArray(); // Variable dependiente (valor del dato)

            // Crear y entrenar el modelo de regresión lineal
            $regression = new LeastSquares();
            $regression->train($samples, $targets);

            // Realizar una predicción para cada registro del grupo
            $predicciones = $grupo->map(function ($dato) use ($regression) {
                return [
                    'tipo_sensor_id' => $dato->sensor->tipo_sensor_id,
                    'prediccion' => $regression->predict([$dato->sensor->tipo_sensor_id]),
                ];
            })->toArray();

            // Guardar las predicciones por reserva
            $resultados[$reservaId] = $predicciones;
        }

        // 5. Mostrar los resultados de todas las predicciones
        return response()->json([
            'resultados' => $resultados,
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
