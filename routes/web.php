<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // Route::view('/produtos', 'produtos')->name('produtos');


})->middleware(['auth', 'verified']);

// Route::controller(ProductController::class)->group(function () {
//     Route::get('/produtos','index')->name('produtos');
// });

Route::get('users', [UserController::class, 'index'])->name('users.index');


Route::prefix('produtos')->name('produtos.')->controller(ProductController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{product_id}','edit')->name('edit');
    Route::put('/{product_id}', 'update')->name('update');
    Route::delete('/{product_id}', 'destroy')->name('destroy');
});

Route::prefix('promocoes')->name('promocoes.')->controller(SaleController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{product_id}','edit')->name('edit');
    Route::put('/{product_id}', 'update')->name('update');
    Route::delete('/{product_id}', 'destroy')->name('destroy');
});

Route::get('/produtos/{product_id}/create', [ProductPriceController::class, 'create'])->name('productprices.create');
Route::get('/priceproduct{priceproduct_id}', [ProductPriceController::class, 'edit'])->name('productprices.edit');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
