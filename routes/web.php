<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubSubCategoryController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(['auth']);
Route::get('/dashboard/sells', [DashboardController::class, 'sells'])->name('dashboard.sells')->middleware(['auth']);
Route::get('/dashboard/sells-of-month', [DashboardController::class, 'monthly_sells'])->name('dashboard.monthly_sells')->middleware(['auth']);
Route::get('/dashboard/commandes', [DashboardController::class, 'commandes'])->name('dashboard.commande.index')->middleware(['auth']);
Route::get('/dashboard/commande/{id}', [DashboardController::class, 'commande'])->name('dashboard.commande.show')->middleware(['auth']);
Route::get('/dashboard/recettes', [DashboardController::class, 'recettes'])->name('dashboard.recette.index')->middleware(['auth']);
Route::get('/dashboard/services', [DashboardController::class, 'services'])->name('dashboard.service.index')->middleware(['auth']);
Route::get('/dashboard/recette', [DashboardController::class, 'recette'])->name('dashboard.recette')->middleware(['auth']);
Route::get('/dashboard/service/{id}', [DashboardController::class, 'service'])->name('dashboard.service.show')->middleware(['auth']);
Route::get('/dashboard/service/{id}/inprogress', [DashboardController::class, 'service_inprogress'])->name('dashboard.service.inprogress')->middleware('auth');
Route::post('/dashboard/service/{id}/done', [DashboardController::class, 'service_done'])->name('dashboard.service.done')->middleware('auth');
Route::get('/dashboard/product', [DashboardController::class, 'products'])->name('dashboard.product.index')->middleware('auth');
Route::get('/dashboard/product/{id}', [DashboardController::class, 'product'])->name('dashboard.product.show')->middleware('auth');

Route::resource('product', ProductController::class)->middleware('auth');
/*
Route::get('/dashboard/product', [ProductController::class, 'index'])->name('dashboard.product.index')->middleware('auth');
Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create')->middleware('auth');
Route::get('/dashboard/product/{id}', [ProductController::class, 'show'])->name('dashboard.product.show')->middleware('auth');
Route::post('/dashboard/product', [ProductController::class, 'store'])->name('dashboard.product.store')->middleware('auth');
Route::get('/dashboard/product/{id}/edit', [ProductController::class, 'edit'])->name('dashboard.product.edit')->middleware('auth');
Route::put('/dashboard/product/{id}', [ProductController::class, 'update'])->name('dashboard.product.update')->middleware('auth');
Route::delete('/dashboard/product/{id}', [ProductController::class, 'destroy'])->name('dashboard.product.destroy')->middleware('auth');
*/

Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin.index')->middleware('auth');
Route::get('/dashboard/admin/create', [AdminController::class, 'create'])->name('dashboard.admin.create')->middleware('auth');
Route::get('/dashboard/admin/{id}', [AdminController::class, 'show'])->name('dashboard.admin.show')->middleware('auth');
Route::post('/dashboard/admin', [AdminController::class, 'store'])->name('dashboard.admin.store')->middleware('auth');
Route::get('/dashboard/admin/{id}/edit', [AdminController::class, 'edit'])->name('dashboard.admin.edit')->middleware('auth');
Route::put('/dashboard/admin/{id}', [AdminController::class, 'update'])->name('dashboard.admin.update')->middleware('auth');
Route::delete('/dashboard/admin/{id}', [AdminController::class, 'destroy'])->name('dashboard.admin.destroy')->middleware('auth');
Route::get('/dashboard/admin/{id}/blocked', [AdminController::class, 'blocked'])->name('dashboard.admin.blocked')->middleware('auth');
Route::get('/dashboard/admin/{id}/unblocked', [AdminController::class, 'unblocked'])->name('dashboard.admin.unblocked')->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::get('/dashboard/user/index', [UserController::class, 'index'])->name('dashboard.user.index')->middleware('auth');
Route::get('/dashboard/user/{id}/blocked', [UserController::class, 'blocked'])->name('dashboard.user.blocked')->middleware('auth');
Route::get('/dashboard/user/{id}/unblocked', [UserController::class, 'unblocked'])->name('dashboard.user.unblocked')->middleware('auth');
Route::delete('/dashboard/user/{id}', [UserController::class, 'destroy'])->name('dashboard.user.destroy')->middleware('auth');
Route::get('/profile/{id}', [UserController::class, 'show'])->name('user.show')->middleware('auth');
Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');

Route::resource('panier', PanierController::class);

Route::get('/category/{category}', [PageController::class, 'product_per_category'])->name('product_per_category');
Route::get('/category/{category}/{sub_category}', [PageController::class, 'product_per_sub_category'])->name('product_per_sub_category');
Route::get('/category/{category}/{sub_category}/{sub_sub_category}', [PageController::class, 'product_per_sub_sub_category'])->name('product_per_sub_sub_category');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/product', [ProductController::class, 'list'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/files/{product_id}', [ProductController::class, 'product_files_ajax'])->name('product.product_files_ajax');
Route::get('/products/more-products/{page_number}', [ProductController::class, 'more_products_ajax'])->name('product.more_products_ajax');
Route::get('/search', [PageController::class, 'search'])->name('search');

Route::resource('commande', CommandeController::class)->middleware('auth');
Route::get('/my-commande/{user_id}', [CommandeController::class, 'my_commande'])->name('my_commande')->middleware('auth');
Route::get('/delivered/{id}', [CommandeController::class, 'delivered'])->name('delivered')->middleware('auth');
Route::get('/commande/{id}/paiement', [CommandeController::class, 'create_paiement'])->name('commande.create_paiement')->middleware('auth');
Route::post('/commande/{id}/paiement', [CommandeController::class, 'store_paiement'])->name('commande.store_paiement')->middleware('auth');

//Route::resource('/dashboard/service', ServiceController::class);
Route::get('/my-service/{user_id}', [ServiceController::class, 'index'])->name('service.index')->middleware('auth');
Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create')->middleware('auth');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show')->middleware('auth');
Route::post('/service', [ServiceController::class, 'store'])->name('service.store')->middleware('auth');
Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit')->middleware('auth');
Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update')->middleware('auth');
Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy')->middleware('auth');

Route::get('/dashboard/rayon', [RayonController::class, 'index'])->name('dashboard.rayon.index')->middleware('auth');
Route::get('/dashboard/rayon/create', [RayonController::class, 'create'])->name('dashboard.rayon.create')->middleware('auth');
Route::get('/dashboard/rayon/{id}', [RayonController::class, 'show'])->name('dashboard.rayon.show')->middleware('auth');
Route::post('/dashboard/rayon', [RayonController::class, 'store'])->name('dashboard.rayon.store')->middleware('auth');
Route::get('/dashboard/rayon/{id}/edit', [RayonController::class, 'edit'])->name('dashboard.rayon.edit')->middleware('auth');
Route::put('/dashboard/rayon/{id}', [RayonController::class, 'update'])->name('dashboard.rayon.update')->middleware('auth');
Route::delete('/dashboard/rayon/{id}', [RayonController::class, 'destroy'])->name('dashboard.rayon.destroy')->middleware('auth');

Route::get('/dashboard/rayon/{id}/categories', [RayonController::class, 'categories'])->name('dashboard.rayon.categories')->middleware('auth');

Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('dashboard.category.index')->middleware('auth');
Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('dashboard.category.create')->middleware('auth');
Route::get('/dashboard/category/{id}', [CategoryController::class, 'show'])->name('dashboard.category.show')->middleware('auth');
Route::post('/dashboard/category', [CategoryController::class, 'store'])->name('dashboard.category.store')->middleware('auth');
Route::get('/dashboard/category/{id}/edit', [CategoryController::class, 'edit'])->name('dashboard.category.edit')->middleware('auth');
Route::put('/dashboard/category/{id}', [CategoryController::class, 'update'])->name('dashboard.category.update')->middleware('auth');
Route::delete('/dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy')->middleware('auth');

Route::get('/dashboard/category/{id}/sub_categories', [CategoryController::class, 'sub_categories'])->name('dashboard.category.sub_categories')->middleware('auth');

Route::get('/dashboard/sub_category', [SubCategoryController::class, 'index'])->name('dashboard.sub_category.index')->middleware('auth');
Route::get('/dashboard/sub_category/create', [SubCategoryController::class, 'create'])->name('dashboard.sub_category.create')->middleware('auth');
Route::get('/dashboard/sub_category/{id}', [SubCategoryController::class, 'show'])->name('dashboard.sub_category.show')->middleware('auth');
Route::post('/dashboard/sub_category', [SubCategoryController::class, 'store'])->name('dashboard.sub_category.store')->middleware('auth');
Route::get('/dashboard/sub_category/{id}/edit', [SubCategoryController::class, 'edit'])->name('dashboard.sub_category.edit')->middleware('auth');
Route::put('/dashboard/sub_category/{id}', [SubCategoryController::class, 'update'])->name('dashboard.sub_category.update')->middleware('auth');
Route::delete('/dashboard/sub_category/{id}', [SubCategoryController::class, 'destroy'])->name('dashboard.sub_category.destroy')->middleware('auth');

Route::get('/dashboard/sub_category/{id}/sub_sub_categories', [SubCategoryController::class, 'sub_sub_categories'])->name('dashboard.sub_category.sub_sub_categories')->middleware('auth');

Route::get('/dashboard/sub_sub_category', [SubSubCategoryController::class, 'index'])->name('dashboard.sub_sub_category.index')->middleware('auth');
Route::get('/dashboard/sub_sub_category/create', [SubSubCategoryController::class, 'create'])->name('dashboard.sub_sub_category.create')->middleware('auth');
Route::get('/dashboard/sub_sub_category/{id}', [SubSubCategoryController::class, 'show'])->name('dashboard.sub_sub_category.show')->middleware('auth');
Route::post('/dashboard/sub_sub_category', [SubSubCategoryController::class, 'store'])->name('dashboard.sub_sub_category.store')->middleware('auth');
Route::get('/dashboard/sub_sub_category/{id}/edit', [SubSubCategoryController::class, 'edit'])->name('dashboard.sub_sub_category.edit')->middleware('auth');
Route::put('/dashboard/sub_sub_category/{id}', [SubSubCategoryController::class, 'update'])->name('dashboard.sub_sub_category.update')->middleware('auth');
Route::delete('/dashboard/sub_sub_category/{id}', [SubSubCategoryController::class, 'destroy'])->name('dashboard.sub_sub_category.destroy')->middleware('auth');


Route::resource('/paiement', PaiementController::class);

Route::get('/cinetpay', function () {
    return view('pages.cinetPay');
})->middleware(['auth'])->name('cinetpay');
