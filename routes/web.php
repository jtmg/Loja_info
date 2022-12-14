<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/produtos',[ProductsController::class, "index"])->name("products.index");
Route::get('/produtos/tipo/{id}',[ProductsController::class, "produtosPorTipo"])->name("products.by.tipo");
Route::post('/produtos',[ProductsController::class, "store"])->name("products.store")->middleware("auth");
Route::get('/produtos/create', [ProductsController::class,"create"])->name("products.create")->middleware("auth");
Route::get('/produtos/edit/{id}', [ProductsController::class,"edit"])->name("products.edit")->middleware("auth");
Route::get('/produtos/{id}', [ProductsController::class,"show"])->name("products.show");
Route::put('/produtos/{id}}', [ProductsController::class,"update"])->name("products.update")->middleware("auth");
Route::delete('/produtos/{id}', [ProductsController::class,"destroy"])->name("products.destroy")->middleware("auth");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
