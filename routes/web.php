<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}/edit', [CategoryController::class, 'destroy'])->name('categories.delete');
        
        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');
        
        // Product Image
        Route::get('/products/{ProductID}/images', [ProductController::class, 'images'])->name('products.images');
        Route::get('/products/{ProductID}/add-images', [ProductController::class, 'add_image'])->name('products.add.image');
        Route::post('/products/{ProductID}/upload-images', [ProductController::class, 'upload_image'])->name('products.upload.image');
        Route::delete('/products/{ImageID}/remove-images', [ProductController::class, 'remove_image'])->name('products.rm.image');
        
        // Attributes
        Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes');
        Route::get('/attributes/create', [AttributeController::class, 'create'])->name('attributes.create');
        Route::post('/attributes/store', [AttributeController::class, 'store'])->name('attributes.store');
        Route::get('/attributes/{id}/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
        Route::put('/attributes/{id}/update', [AttributeController::class, 'update'])->name('attributes.update');
        Route::delete('/attributes/{id}/delete', [AttributeController::class, 'destroy'])->name('attributes.delete');
        Route::get('/attributes/{id}/options', [AttributeController::class, 'options'])->name('attributes.options');

    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
