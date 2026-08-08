<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmpleadoController::class, 'index'])->name('home');
Route::resource('empleados', EmpleadoController::class);
