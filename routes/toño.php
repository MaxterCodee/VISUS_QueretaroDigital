<?php

use Illuminate\Support\Facades\Route;

Route::get('/toño', function () {
    return 'Ruta de Toño';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // AQUI VAN LAS RUTAS QUE REQUIEREN AUTENTICACION


});
