<?php

use Illuminate\Support\Facades\Route;
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
