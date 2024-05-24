<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectoriesController; // Asegúrate de importar el controlador

Route::get('/', function () {
    return view('welcome');
});

// Nueva ruta para listar directorios
Route::get('/list-directories', [DirectoryListController::class, 'index']);

