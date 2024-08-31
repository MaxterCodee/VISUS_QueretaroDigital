<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;

Route::get('/leo', function () {
    return 'Ruta de Leo';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // AQUI VAN LAS RUTAS QUE REQUIEREN AUTENTICACION
    Route::get('/admin/tipoReserva',[AdministradorController::class, 'indexTipoReserva'])->name('indexTipoReserva');
    Route::get('/admin/reserva',[AdministradorController::class, 'indexReserva'])->name('indexReserva');

});
