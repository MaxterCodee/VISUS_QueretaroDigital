<?php

use Illuminate\Support\Facades\Route;

Route::get('/leo', function () {
    return 'Ruta de Leo';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // AQUI VAN LAS RUTAS QUE REQUIEREN AUTENTICACION


});
