<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Reserva;
use Carbon\Carbon;
use Phpml\Regression\LinearRegression;
use Phpml\Dataset\ArrayDataset;

use Illuminate\Http\Request;
use Phpml\FeatureSelection\ScoringFunction\UnivariateLinearRegression;
use Phpml\Regression\LeastSquares;

class RegresionLinealController extends Controller
{
    public function realizarRegresionLineal($dias = 10)
    {
        $reservas = Reserva::all();
        $resultados = []; // Array para almacenar los resultados

        foreach ($reservas as $reserva) {
            $sensores = $reserva->sensores;

            foreach ($sensores as $sensor) {
                $datos = $sensor->dato;

                $samples = [];
                $targets = [];

                foreach ($datos as $dato) {
                    // Convertir la fecha 'created_at' a un valor numérico, por ejemplo, número de días desde una fecha base
                    $createdAt = Carbon::parse($dato->created_at);
                    $days = $createdAt->diffInDays(Carbon::now()); // Calcula el número de días desde hoy

                    // Agregar el valor y el objetivo a las muestras y targets
                    $samples[] = [$days];
                    $targets[] = $dato->valor;
                }

                // Asegúrate de tener al menos dos puntos de datos para hacer una regresión
                if (count($samples) > 1) {
                    // Entrenar el modelo de regresión lineal para el sensor
                    $regression = new LeastSquares();
                    $regression->train($samples, $targets);

                    // Predecir valores usando el modelo entrenado
                    $predictedValue = $regression->predict([$dias]);

                    // Guardar los resultados en el array
                    $resultados[] = [
                        'sensor_id' => $sensor->id,
                        'reserva_name' => $sensor->reserva->nombre,
                        'sensor_name' => $sensor->nombre,
                        'unidad_medida' => $sensor->tipoSensor->unidad,
                        'samples' => $samples, // Mostrar samples del sensor actual
                        'targets' => $targets, // Mostrar targets del sensor actual
                        'predicted_value' => $predictedValue,
                        'message' => "Valor predicho para {$dias} días desde la fecha base: " . $predictedValue
                    ];
                } else {
                    // Guardar mensaje de error en el array si no hay suficientes datos
                    $resultados[] = [
                        'sensor_id' => $sensor->id,
                        'reserva_name' => $sensor->reserva->nombre,
                        'sensor_name' => $sensor->nombre,
                        'unidad_medida' => $sensor->tipoSensor->unidad,
                        'samples' => $samples, // Mostrar samples del sensor actual
                        'targets' => $targets, // Mostrar targets del sensor actual
                        'predicted_value' => null,
                        'message' => "No hay suficientes datos para realizar la regresión lineal."
                    ];
                }
            }
        }

        // Retornar el array de resultados
        return $resultados;
    }

    public function mostrarResultados(Request $request)
    {
        $dias = $request->input('dias', 10); // Obtener el valor de días desde la solicitud, por defecto 10
        $resultados = $this->realizarRegresionLineal($dias); // Llama al método con el número de días
        return view('regresion.index', compact('resultados', 'dias')); // Pasa los resultados y el número de días a la vista
    }







    // public function realizarRegresionLineal()
    // {
    //     $reservas = Reserva::all();

    //     foreach($reservas as $reserva)
    //     {
    //         $sensores = $reserva->sensores;
    //         foreach($sensores as $sensor)
    //         {
    //             $datos = $sensor->dato;

    //             $samples = [];
    //             $targets = [];

    //             foreach ($datos as $dato) {
    //                 // Convertir la fecha 'created_at' a un valor numérico, por ejemplo, número de días desde una fecha base
    //                 $createdAt = Carbon::parse($dato->created_at);
    //                 $days = $createdAt->diffInDays(Carbon::now()); // Calcula el número de días desde hoy

    //                 // Agregar el valor y el objetivo a las muestras y targets
    //                 $samples[] = [$days];
    //                 $targets[] = $dato->valor;
    //             }

    //             // Asegúrate de tener al menos dos puntos de datos para hacer una regresión
    //             if (count($samples) > 1) {
    //                 // Entrenar el modelo de regresión lineal para el sensor
    //                 $regression = new LeastSquares();
    //                 $regression->train($samples, $targets);

    //                 // Opcional: Predecir valores usando el modelo entrenado
    //                 // Ejemplo: predecir valor para 30 días desde la fecha base
    //                 $predictedValue = $regression->predict([20]);

    //                 echo "Sensor ID: " . $sensor->id . "<br>";
    //                 echo "Valor predicho para 20 días desde la fecha base: " . $predictedValue . "<br>";
    //             } else {
    //                 echo "Sensor ID: " . $sensor->id . " - No hay suficientes datos para realizar la regresión lineal.<br>";
    //             }
    //         }
    //     }
    // }



    // public function realizarRegresionLineal()
    // {
    //     $reservas = Reserva::all();
    //     $samples = [];
    //     $targets = [];

    //     foreach($reservas as $reserva)
    //     {
    //         $sensores = $reserva->sensores;
    //         foreach($sensores as $sensor)
    //         {
    //             $datos = $sensor->dato;

    //             foreach ($datos as $dato) {
    //                 // Convertir la fecha 'created_at' a un valor numérico, por ejemplo, número de días desde una fecha base
    //                 $createdAt = Carbon::parse($dato->created_at);
    //                 $days = $createdAt->diffInDays(Carbon::now()); // Calcula el número de días desde hoy

    //                 // Agregar el valor y el objetivo a las muestras y targets
    //                 $samples[] = [$days];
    //                 $targets[] = $dato->valor;
    //             }
    //         }
    //     }

    //     // Asegúrate de tener al menos dos puntos de datos para hacer una regresión
    //     if (count($samples) > 1) {
    //         // Entrenar el modelo de regresión lineal
    //         $regression = new LeastSquares();
    //         $regression->train($samples, $targets);

    //         // Opcional: Predecir valores usando el modelo entrenado
    //         $predictedValue = $regression->predict([30]); // Ejemplo: predecir valor para 30 días desde la fecha base

    //         echo "Valor predicho para 30 días desde la fecha base: " . $predictedValue;
    //     } else {
    //         echo "No hay suficientes datos para realizar la regresión lineal.";
    //     }
    // }




    // public function realizarRegresionLineal()
    // {
    //     $reservas = Reserva::all();
    //     foreach($reservas as $reserva)
    //     {
    //         $sensores = $reserva->sensores;
    //         foreach($sensores as $sensor)
    //         {
    //             $datos = $sensor->dato;
    //             // dd($datos);
    //             echo '<pre>';
    //             print_r($datos);
    //             echo '</pre>';


    //         }
    //     }
    // }
}


