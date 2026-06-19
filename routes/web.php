<?php

use App\Http\Controllers\JugadorController;
use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JugadorController::class, 'home']);

Route::get('/ranking', [JugadorController::class, 'ranking'])
    ->name('ranking');

Route::resource('jugadores', JugadorController::class);

Route::resource('equipos', EquipoController::class);