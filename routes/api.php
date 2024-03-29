<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// PSR do Luis: os métodos API deverão ser obrigatoriamente nomeados com api.<nome_do_recurso>

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('produto', ProductController::class);

Route::resource('priceproduct', ProductPriceController::class);

Route::resource('apisale', SaleController::class);

Route::resource('apiclients', ClientController::class);

Route::resource('apivenda', VendaController::class);

Route::resource('apistore', StoreController::class);

Route::resource('apisupplier', SupplierController::class);
