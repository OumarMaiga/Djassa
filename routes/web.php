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
use App\Http\Controllers\PaiementController;

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

//Route::resource('dashboard/product', ProductController::class)->middleware('auth');
Route::get('dashboard/product', [ProductController::class, 'index'])->name('dashboard.product.index')->middleware('auth');
Route::get('dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create')->middleware('auth');
Route::get('dashboard/product/{id}', [ProductController::class, 'show'])->name('dashboard.product.show')->middleware('auth');
Route::post('dashboard/product', [ProductController::class, 'store'])->name('dashboard.product.store')->middleware('auth');
Route::get('dashboard/product/{id}/edit', [ProductController::class, 'edit'])->name('dashboard.product.edit')->middleware('auth');
Route::put('dashboard/product/{id}', [ProductController::class, 'update'])->name('dashboard.product.update')->middleware('auth');
Route::delete('dashboard/product/{id}', [ProductController::class, 'destroy'])->name('dashboard.product.destroy')->middleware('auth');

Route::get('dashboard/user/', [UserController::class, 'index'])->name('dashboard.user.index')->middleware('auth');
Route::get('dashboard/user/{id}', [UserController::class, 'show'])->name('dashboard.user.show')->middleware('auth');
Route::get('dashboard/user/{id}/blocked', [UserController::class, 'blocked'])->name('dashboard.user.blocked')->middleware('auth');
Route::get('dashboard/user/{id}/unblocked', [UserController::class, 'unblocked'])->name('dashboard.user.unblocked')->middleware('auth');
Route::delete('dashboard/user/{id}', [UserController::class, 'destroy'])->name('dashboard.user.destroy')->middleware('auth');

Route::resource('panier', PanierController::class);

Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/product_per_category/{category}', [PageController::class, 'product_per_category'])->name('product_per_category');
Route::get('/product', [ProductController::class, 'list'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/dashboard/recettes', [PageController::class, 'recettes'])->name('recettes');

Route::resource('commande', CommandeController::class)->middleware('auth');
Route::get('/my_commande/{user_id}', [CommandeController::class, 'my_commande'])->name('my_commande')->middleware('auth');
Route::get('/delivered/{id}', [CommandeController::class, 'delivered'])->name('delivered')->middleware('auth');
Route::get('/commande/{id}/paiement', [CommandeController::class, 'create_paiement'])->name('commande.create_paiement')->middleware('auth');
Route::post('/commande/{id}/paiement', [CommandeController::class, 'store_paiement'])->name('commande.store_paiement')->middleware('auth');


Route::resource('service', ServiceController::class);
Route::get('service/{id}/inprogress', [ServiceController::class, 'inprogress'])->name('service.inprogress');
Route::post('service/{id}/done', [ServiceController::class, 'done'])->name('service.done');

//Route::resource('dashboard/category', CategoryController::class)->middleware('auth');
Route::get('dashboard/category', [CategoryController::class, 'index'])->name('dashboard.category.index')->middleware('auth');
Route::get('dashboard/category/create', [CategoryController::class, 'create'])->name('dashboard.category.create')->middleware('auth');
Route::get('dashboard/category/{id}', [CategoryController::class, 'show'])->name('dashboard.category.show')->middleware('auth');
Route::post('dashboard/category', [CategoryController::class, 'store'])->name('dashboard.category.store')->middleware('auth');
Route::get('dashboard/category/{id}/edit', [CategoryController::class, 'edit'])->name('dashboard.category.edit')->middleware('auth');
Route::put('dashboard/category/{id}', [CategoryController::class, 'update'])->name('dashboard.category.update')->middleware('auth');
Route::delete('dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy')->middleware('auth');

//Route::resource('dashboard/rayon', RayonController::class)->middleware('auth');
Route::get('dashboard/rayon', [RayonController::class, 'index'])->name('dashboard.rayon.index')->middleware('auth');
Route::get('dashboard/rayon/create', [RayonController::class, 'create'])->name('dashboard.rayon.create')->middleware('auth');
Route::get('dashboard/rayon/{id}', [RayonController::class, 'show'])->name('dashboard.rayon.show')->middleware('auth');
Route::post('dashboard/rayon', [RayonController::class, 'store'])->name('dashboard.rayon.store')->middleware('auth');
Route::get('dashboard/rayon/{id}/edit', [RayonController::class, 'edit'])->name('dashboard.rayon.edit')->middleware('auth');
Route::put('dashboard/rayon/{id}', [RayonController::class, 'update'])->name('dashboard.rayon.update')->middleware('auth');
Route::delete('dashboard/rayon/{id}', [RayonController::class, 'destroy'])->name('dashboard.rayon.destroy')->middleware('auth');


Route::resource('paiement', PaiementController::class);
