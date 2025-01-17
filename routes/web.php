<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/admin/tables', function () {
    return view('admin.tables');
});



Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('admin.category.index');
        Route::get('/categories/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/categories/edit/{category}', 'edit')->name('admin.category.edit');
        Route::patch('/categories/{category}', 'update')->name('admin.category.update');
        Route::delete('/categories/{category}', 'destroy')->name('admin.category.destroy');
    });

});

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('/brands', 'index')->name('admin.brand.index');
        Route::get('/brands/create', 'create')->name('admin.brand.create');
        Route::post('/brand', 'store')->name('admin.brand.store');
        Route::get('/brands/edit/{brand}', 'edit')->name('admin.brand.edit');
        Route::patch('/brands/{brand}/', 'update')->name('admin.brand.update');
        Route::delete('/brands/{brand}/', 'destroy')->name('admin.brand.destroy');
    });

});

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.product.index');
        Route::get('/products/create', 'create')->name('admin.product.create');
        Route::post('/product', 'store')->name('admin.product.store');
        Route::get('/products/edit/{product}', 'edit')->name('admin.product.edit');
        Route::patch('/products/{product}/', 'update')->name('admin.product.update');
        Route::delete('/products/{product}/', 'destroy')->name('admin.product.destroy');
    });

});













