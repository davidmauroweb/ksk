<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoriaController,ClienteController,MarcaController,MovController,VtaController,HomeController};

Route::get('/', function () {
    return view('auth/login');
});

#Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/cat', [CategoriaController::class, 'index'])->name('cat');
Route::post('/ncat', [CategoriaController::class, 'store'])->name('ncat');
Route::post('/dcat', [CategoriaController::class, 'destroy'])->name('dcat');