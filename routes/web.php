<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommandeController;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('dashboard/product', ProductController::class)->middleware('auth');

Route::resource('panier', PanierController::class);

Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/dashboard/recettes', [PageController::class, 'recettes'])->name('recettes');

Route::resource('commande', CommandeController::class);
Route::get('/my_commande/{user_id}', [CommandeController::class, 'my_commande'])->name('my_commande');
Route::get('/delivered/{id}', [CommandeController::class, 'delivered'])->name('delivered');