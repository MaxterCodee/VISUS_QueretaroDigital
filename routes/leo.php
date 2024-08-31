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

    //Aqui van las rutas de vistas
    Route::get('/admin/tipoReserva',[AdministradorController::class, 'indexTipoReserva'])->name('indexTipoReserva');
    Route::get('/admin/reserva',[AdministradorController::class, 'indexReserva'])->name('indexReserva');
    Route::get('/admin/sensor',[AdministradorController::class, 'indexSensor'])->name('indexSensor');
    Route::get('/admin/tipoSensor',[AdministradorController::class, 'indexTipoSensor'])->name('indexTipoSensor');
    Route::get('/admin/bomba',[AdministradorController::class, 'indexBomba'])->name('indexBomba');

    //Aqui van las rutas de creacion
    Route::post('/admin/tipoReserva',[AdministradorController::class, 'crearReser'])->name('crearReser');
    Route::post('/admin/reserva',[AdministradorController::class, 'crearReserva'])->name('crearReserva');
    Route::post('/admin/sensor',[AdministradorController::class, 'crearSensor'])->name('crearSensor');
    Route::post('/admin/tipoSensor',[AdministradorController::class, 'crearTipoSensor'])->name('crearTipoSensor');
    Route::post('/admin/bomba',[AdministradorController::class, 'crearBomba'])->name('crearBomba');

    //Aqui van las rutas de edicion
    Route::put('/admin/tipoReserva',[AdministradorController::class, 'editarReser'])->name('editarReser');
    Route::put('/admin/reserva',[AdministradorController::class, 'editarReserva'])->name('editarReserva');
    Route::put('/admin/sensor',[AdministradorController::class, 'editarSensor'])->name('editarSensor');
    Route::put('/admin/tipoSensor',[AdministradorController::class, 'editarTipoSensor'])->name('editarTipoSensor');
    Route::put('/admin/bomba',[AdministradorController::class, 'editarBomba'])->name('editarBomba');

    //Aqui van las rutas de eliminacion
    Route::delete('/admin/tipoReserva',[AdministradorController::class, 'eliminarReser'])->name('eliminarReser');
    Route::delete('/admin/reserva',[AdministradorController::class, 'eliminarReserva'])->name('eliminarReserva');
    Route::delete('/admin/sensor',[AdministradorController::class, 'eliminarSensor'])->name('eliminarSensor');
    Route::delete('/admin/tipoSensor',[AdministradorController::class, 'eliminarTipoSensor'])->name('eliminarTipoSensor');
    Route::delete('/admin/bomba',[AdministradorController::class, 'eliminarBomba'])->name('eliminarBomba');

    Route::get('/admin/predicción',[AdministradorController::class, 'indexMapas'])->name('indexMapas');

});
