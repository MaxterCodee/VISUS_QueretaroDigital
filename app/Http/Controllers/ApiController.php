<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;

class ApiController extends Controller
{
    public function tipo_reserva()
    {
        $TipoReserva = TipoReserva::all();

        return response()->json($TipoReserva);
    }

    public function index()
    {
        return view('chatbot');
    }
}
