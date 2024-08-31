<?php

use App\Http\Controllers\RegresionLinealController;
use Illuminate\Support\Facades\Route;

Route::get('/max', function () {
    return 'Ruta de Max';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // AQUI VAN LAS RUTAS QUE REQUIEREN AUTENTICACION
    Route::get('/regresion-linear', [RegresionLinealController::class, 'realizarRegresionLineal']);
    Route::get('/regresion', [RegresionLinealController::class, 'mostrarResultados']);

});
