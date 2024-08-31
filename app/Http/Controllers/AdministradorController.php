<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;
use App\Models\Reserva;
use App\Models\Sensore;
use App\Models\TipoSensor;



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
        $reserva = Reserva::all();
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


}
