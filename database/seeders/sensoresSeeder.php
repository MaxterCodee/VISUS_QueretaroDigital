<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sensore;
use App\Models\TipoReserva;
use App\Models\TipoSensor;
use App\Models\Reserva;

class sensoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tipoReserva = TipoReserva::create([
            'nombre' => 'Aguas superficiales',
            'descripcion' => 'Aguas superficiales',
        ]);

        $tipoReserva2 = TipoReserva::create([
            'nombre' => 'Aguas subterraneas',
            'descripcion' => 'Aguas subterraneas',
        ]);

        $tipoReserva3 = TipoReserva::create([
            'nombre' => 'Lluvia',
            'descripcion' => 'Lluvia',
        ]);

        $reserva = Reserva::create([
            'nombre' => 'Acueducto II',
            'descripcion' => 'Holis',
            'coordenadas' => '20.676707, -100.309517',
            'tipo_reserva_id' => 1
        ]);

        $reserva1 = Reserva::create([
            'nombre' => 'Acuifero de Guadalupe',
            'descripcion' => 'Holisx2',
            'coordenadas' => '20.439823, -100.089939',
            'tipo_reserva_id' => 2
        ]);

        $tiposensores = TipoSensor::create([
            'nombre' => 'Presion',
            'max_val' => 50,
            'min_val' => 0,
            'unidad' => 'psi',
        ]);

        $tiposensores2 = TipoSensor::create([
            'nombre' => 'Voltaje',
            'max_val' => 50,
            'min_val' => 0,
            'unidad' => 'V',
        ]);

        $tiposensores3 = TipoSensor::create([
            'nombre' => 'Nivel de agua',
            'max_val' => 50,
            'min_val' => 0,
            'unidad' => 'm',
        ]);

        $tiposensores4 = TipoSensor::create([
            'nombre' => 'Caudal',
            'max_val' => 50,
            'min_val' => 0,
            'unidad' => 'm3/s',
        ]);

        // Obtener todas las reservas y tipos de sensores
        $reservas = Reserva::all();
        $tiposSensores = TipoSensor::all();

        // Crear un sensor para cada reserva y asignarle un tipo de sensor
        for ($i = 0; $i < 10; $i++) {
            $reserva = $reservas->random(); // Seleccionar una reserva aleatoria
            $tipoSensor = $tiposSensores->random(); // Seleccionar un tipo de sensor aleatorio
            Sensore::create([
                'nombre' => 'Sensor de ' . $tipoSensor->nombre,
                'tipo_sensor_id' => $tipoSensor->id,
                'reserva_id' => $reserva->id,
            ]);
        }

    }
}
