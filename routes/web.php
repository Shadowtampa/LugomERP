<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\ProfileController;
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


Route::get('produtos', [ProductController::class, 'index'])->name('produtos');
Route::get('produtos/create', [ProductController::class, 'create'])->name('produtos.create');
Route::get('/produtos{product_id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/produtos{$product_id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/produtos{$product_id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/produtos{product_id}/create', [ProductPriceController::class, 'create'])->name('productprices.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
