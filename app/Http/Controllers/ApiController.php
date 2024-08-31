<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;
use App\Models\Sensore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
     // Obtener datos de todas las tablas
     public function getDatabaseData()
     {
         $tables = DB::select('SHOW TABLES');
         $database = env('DB_DATABASE');
         $tables = array_map(function($table) use ($database) {
             return $table->{"Tables_in_$database"};
         }, $tables);

         $data = [];
         foreach ($tables as $table) {
             $data[$table] = DB::table($table)->get()->toArray();
         }

         return response()->json($data);
     }

     // Enviar datos a la API de GPT-4 y obtener la respuesta
     public function postChat(Request $request)
     {
         $userMessage = $request->input('userMessage');

         // Obtener los datos de la base de datos
         $data = $this->getDatabaseData()->getData();
         $dataString = json_encode($data);

         // Preparar la solicitud a la API de GPT-4
         $response = Http::withHeaders([
             'Content-Type' => 'application/json',
             'Authorization' => 'Bearer be1ee4c179f644d390fa239d1001d2f9'
         ])->post('https://api.aimlapi.com/v1/chat/completions', [
             'model' => 'gpt-4',
             'messages' => [
                 [
                     'role' => 'system',
                     'content' => 'You are an AI assistant who knows everything.'
                 ],
                 [
                     'role' => 'user',
                     'content' => "Interpreta el siguiente array de datos: $dataString y responde a esta pregunta: $userMessage"
                 ]
             ],
             'max_tokens' => 50, // Ajusta según necesites
             'stop' => ['\n'],
         ]);

         if ($response->successful()) {
             $result = $response->json();
             return response()->json(['response' => $result['choices'][0]['message']['content']]);
         } else {
             return response()->json(['response' => 'Error al obtener respuesta.'], $response->status());
         }
     }

    public function index()
    {
        return view('chatbot');
    }
}
