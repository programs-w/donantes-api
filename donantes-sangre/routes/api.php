<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonanteController;

Route::get('/donantes',[DonanteController::class,'obtenerTodosDonantes']);
Route::get('/donantes/{id}',[DonanteController::class,'obtenerDonantePorId']);
Route::post('/donantes', [DonanteController::class,'crearDonante']);
Route::put('/donantes/{id}', [DonanteController::class,'actualizarDonante']);
Route::delete('/donantes/{id}', [DonanteController::class, 'borrarDonante']);

//Endpoint para crear las donaciones del donante
Route::post('/donantes/donaciones',[DonanteController::class,'crearDonacion']);
