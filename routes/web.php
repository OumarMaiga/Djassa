<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RayonController;

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

Route::get('/', [PageController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('dashboard/product', ProductController::class)->middleware('auth');
Route::get('dashboard/user/{id}', [UserController::class, 'show'])->name('dashboard.user.show')->middleware('auth');
Route::get('dashboard/user/{id}/blocked', [UserController::class, 'blocked'])->name('dashboard.user.blocked')->middleware('auth');
Route::delete('dashboard/user/{id}', [UserController::class, 'destroy'])->name('dashboard.user.destroy')->middleware('auth');

Route::resource('panier', PanierController::class);

Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/vegetables', [PageController::class, 'vegetables'])->name('vegetables');
Route::get('/product/{id}', [ProductController::class, 'product'])->name('product');
Route::get('/dashboard/recettes', [PageController::class, 'recettes'])->name('recettes');

Route::resource('commande', CommandeController::class);
Route::get('/my_commande/{user_id}', [CommandeController::class, 'my_commande'])->name('my_commande');
Route::get('/delivered/{id}', [CommandeController::class, 'delivered'])->name('delivered');

Route::resource('service', ServiceController::class);
Route::get('service/{id}/inprogress', [ServiceController::class, 'inprogress'])->name('service.inprogress');
Route::get('service/{id}/done', [ServiceController::class, 'done'])->name('service.done');

Route::resource('dashboard/category', CategoryController::class)->middleware('auth');
Route::resource('dashboard/rayon', RayonController::class)->middleware('auth');
