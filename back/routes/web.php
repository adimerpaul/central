<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pagos/{codigo}/print', [App\Http\Controllers\PagoConceptoController::class, 'print']);
