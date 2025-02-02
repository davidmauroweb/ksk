<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoriaController,ClienteController,MarcaController,MovController,VtaController,HomeController};

Route::get('/', function () {
    return view('auth/login');
});

#Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/pw', [HomeController::class, 'pw'])->name('pw');
#Categorias
Route::get('/cat', [CategoriaController::class, 'index'])->name('cat');
Route::post('/ncat', [CategoriaController::class, 'store'])->name('ncat');
Route::post('/dcat', [CategoriaController::class, 'destroy'])->name('dcat');
Route::post('/ecat', [CategoriaController::class, 'edit'])->name('ecat');
#Marcas
Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas');
Route::post('/nmarcas', [MarcaController::class, 'store'])->name('nmarcas');
Route::post('/dmarcas', [MarcaController::class, 'destroy'])->name('dmarcas');
Route::post('/emarcas', [MarcaController::class, 'edit'])->name('emarcas');