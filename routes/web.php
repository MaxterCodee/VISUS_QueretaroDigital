<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/toño.php';
require __DIR__.'/dario.php';
require __DIR__.'/leo.php';
require __DIR__.'/max.php';



// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');


});
