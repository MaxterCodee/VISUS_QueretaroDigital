<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;
use App\Models\Reserva;
use App\Models\Sensore;
use App\Models\TipoSensor;
use App\Models\Bomba;



class AdministradorController extends Controller
{
    //Tipo de Reserva
    public function indexTipoReserva(){
        $tipoReserva = TipoReserva::all();

        return view('administrador.tipoReserva', compact('tipoReserva'));
    }
    public function crearReser(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $reserva = TipoReserva::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('indexTipoReserva');
    }

    public function editarReser(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $reserva = TipoReserva::find($request->id);
        $reserva->nombre = $request->nombre;
        $reserva->descripcion = $request->descripcion;
        $reserva->save();

        return redirect()->route('indexTipoReserva');
    }

    public function eliminarReser(Request $request){
        $reserva = TipoReserva::find($request->id);
        $reserva->delete();

        return redirect()->route('indexTipoReserva');
    }

    //Reserva
    public function indexReserva(){
        $reserva = Reserva::with('tipos')->get();
        $tipo = TipoReserva::all();
        return view('administrador.reserva', compact('reserva','tipo'));
    }

    public function crearReserva(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'coordenadas' => 'required',
            'tipo_reserva_id' => 'required',
        ]);

        $reserva = Reserva::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'coordenadas' => $request->coordenadas,
            'tipo_reserva_id' => $request->tipo_reserva_id,
        ]);

        return redirect()->route('indexReserva');
    }

    public function editarReserva(Request $request){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'coordenadas' => 'required',
            'tipo_reserva_id' => 'required',
        ]);

        $reserva = Reserva::find($request->id);
        $reserva->nombre = $request->nombre;
        $reserva->descripcion = $request->descripcion;
        $reserva->coordenadas = $request->coordenadas;
        $reserva->tipo_reserva_id = $request->tipo_reserva_id;
        $reserva->save();

        return redirect()->route('indexReserva');
    }

    public function eliminarReserva(Request $request){
        $reserva = Reserva::find($request->id);
        $reserva->delete();

        return redirect()->route('indexReserva');
    }

    //Sensores
    public function indexSensor(){
        $sensor = Sensore::with('tipoSensor','reserva')->get();
        $tipo = TipoSensor::all();
        return view('administrador.sensor', compact('sensor','tipo'));
    }

    public function crearSensor(Request $request){
        $request->validate([
            'nombre' => 'required',
            'tipo_sensor_id' => 'required',
            'reserva_id' => 'required',
        ]);

        $sensor = Sensore::create([
            'nombre' => $request->nombre,
            'tipo_sensor_id' => $request->tipo_sensor_id,
            'reserva_id' => $request->reserva_id,
        ]);

        return redirect()->route('indexSensor');
    }

    public function editarSensor(Request $request){
        $request->validate([
            'nombre' => 'required',
            'tipo_sensor_id' => 'required',
            'reserva_id' => 'required',
        ]);

        $sensor = Sensore::find($request->id);
        $sensor->nombre = $request->nombre;
        $sensor->tipo_sensor_id = $request->tipo_sensor_id;
        $sensor->reserva_id = $request->reserva_id;
        $sensor->save();

        return redirect()->route('indexSensor');
    }

    public function eliminarSensor(Request $request){
        $sensor = Sensore::find($request->id);
        $sensor->delete();

        return redirect()->route('indexSensor');
    }

    //Tipo de Sensor
    public function indexTipoSensor(){
        $tipoSensor = TipoSensor::all();
        return view('administrador.tipo_sensor', compact('tipoSensor'));
    }

    public function crearTipoSensor(Request $request){
        $request->validate([
            'nombre' => 'required',
            'max_val' => 'required',
            'min_val' => 'required',
            'unidad' => 'required',
        ]);

        $tipoSensor = TipoSensor::create([
            'nombre' => $request->nombre,
            'max_val' => $request->max_val,
            'min_val' => $request->min_val,
            'unidad' => $request->unidad,
        ]);

        return redirect()->route('indexTipoSensor');
    }

    public function editarTipoSensor(Request $request){
        $request->validate([
            'nombre' => 'required',
            'max_val' => 'required',
            'min_val' => 'required',
            'unidad' => 'required',
        ]);

        $tipoSensor = TipoSensor::find($request->id);
        $tipoSensor->nombre = $request->nombre;
        $tipoSensor->max_val = $request->max_val;
        $tipoSensor->min_val = $request->min_val;
        $tipoSensor->unidad = $request->unidad;
        $tipoSensor->save();

        return redirect()->route('indexTipoSensor');
    }

    public function eliminarTipoSensor(Request $request){
        $tipoSensor = TipoSensor::find($request->id);
        $tipoSensor->delete();

        return redirect()->route('indexTipoSensor');
    }

    //Bombas
    public function indexBomba(){
        $bomba = Bomba::all();
        return view('administrador.bomba', compact('bomba'));
    }

    public function crearBomba(Request $request){
        $request->validate([
            'horas_limite' => 'required',
            'horas_actuales' => 'required',
        ]);

        $bomba = Bomba::create([
            'horas_limite' => $request->horas_limite,
            'horas_actuales' => $request->horas_actuales,
        ]);

        return redirect()->route('indexBomba');
    }

    public function editarBomba(Request $request){
        $request->validate([
            'horas_limite' => 'required',
            'horas_actuales' => 'required',
        ]);

        $bomba = Bomba::find($request->id);
        $bomba->horas_limite = $request->horas_limite;
        $bomba->horas_actuales = $request->horas_actuales;
        $bomba->save();

        return redirect()->route('indexBomba');
    }

    public function eliminarBomba(Request $request){
        $bomba = Bomba::find($request->id);
        $bomba->delete();

        return redirect()->route('indexBomba');
    }


    public function indexMapas(){
        $reservas = Reserva::all();
        return view('administrador.predicciones', compact('reservas'));
    }

}
