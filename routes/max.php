<?php

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


});
