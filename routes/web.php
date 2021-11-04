<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginaInicial;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/pagina-inicial", [PaginaInicial::class, 'index'])->name("inicio");
Route::post("/busca-dados", [PaginaInicial::class, 'create'])->name("busca");
