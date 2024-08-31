<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dato;
use App\Models\Sensore;
use Carbon\Carbon;

class datoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sensores = Sensore::all();

        foreach ($sensores as $sensor) {
            $currentTime = Carbon::now(); // Obtener la hora actual
            for ($j = 0; $j < 100; $j++) {
                Dato::create([
                    'valor' => rand(0, 100), // Generar un valor aleatorio para el dato
                    'sensore_id' => $sensor->id,
                    'created_at' => $currentTime, // Asignar la hora actual
                    'updated_at' => $currentTime, // Asignar la hora actual
                ]);
                $currentTime->addDay()->addMinutes(10); // Incrementar la hora en 10 minutos
            }
        }
    }
}
