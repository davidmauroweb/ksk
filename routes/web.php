<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArtController,CategoriaController,ClienteController,MarcaController,MovController,AccController,HomeController};

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
#Clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
Route::post('/nclientes', [ClienteController::class, 'store'])->name('nclientes');
Route::post('/dclientes', [ClienteController::class, 'destroy'])->name('dclientes');
Route::post('/eclientes', [ClienteController::class, 'edit'])->name('eclientes');
#Art
Route::get('/arts', [ArtController::class, 'index'])->name('arts');
Route::post('/narts', [ArtController::class, 'store'])->name('narts');
Route::post('/darts', [ArtController::class, 'destroy'])->name('darts');
Route::post('/earts', [ArtController::class, 'edit'])->name('earts');
#Accion
Route::get('/accshow/{acc}', [AccController::class, 'show'])->name('accshow');
Route::get('/lsacc/{acc}', [AccController::class, 'index'])->name('lsacc');
Route::post('/nacc', [AccController::class, 'store'])->name('nacc');
Route::get('/xcli/{cli_id}', [AccController::class, 'xcli'])->name('xcli');

#Mov
Route::post('/addmv', [MovController::class, 'store'])->name('addmv');
Route::get('/lsmovs/{acc}', [MovController::class, 'show'])->name('lsmovs');