<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// RUTAS QUE NO REQUIEREN AUTENTICACION
Route::get('/dario', function () {
    return 'Ruta de Dario';
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // AQUI VAN LAS RUTAS QUE REQUIEREN AUTENTICACION


});

Route::get('/tipo_reserva', [ApiController::class, 'tipo_reserva']);

Route::get('/chatbot', [ApiController::class, 'index'])->name('chatbot');

Route::get('/database_data', [ApiController::class, 'getDatabaseData']);
Route::post('/chat', [ApiController::class, 'postChat']);
