<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', App\Http\Controllers\Admin\IndexController::class)->name('admin.index');

    Route::prefix('categories')->group(function () {
        Route::get('/', App\Http\Controllers\Admin\Categories\IndexController::class)->name('categories.index');
        Route::get('/create', App\Http\Controllers\Admin\Categories\CreateController::class)->name('categories.create');
        Route::post('/', App\Http\Controllers\Admin\Categories\StoreController::class)->name('categories.store');
        Route::get('/{category}', App\Http\Controllers\Admin\Categories\ShowController::class)->name('categories.show');
        Route::get('/{category}/edit', App\Http\Controllers\Admin\Categories\EditController::class)->name('categories.edit');
        Route::patch('/{category}', App\Http\Controllers\Admin\Categories\UpdateController::class)->name('categories.update');
        Route::delete('/{category}', App\Http\Controllers\Admin\Categories\DestroyController::class)->name('categories.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', App\Http\Controllers\Admin\Products\IndexController::class)->name('products.index');
        Route::get('/create', App\Http\Controllers\Admin\Products\CreateController::class)->name('products.create');
        Route::post('/', App\Http\Controllers\Admin\Products\StoreController::class)->name('products.store');
        Route::get('/{product}', App\Http\Controllers\Admin\Products\ShowController::class)->name('products.show');
        Route::get('/{product}/edit', App\Http\Controllers\Admin\Products\EditController::class)->name('products.edit');
        Route::patch('/{product}', App\Http\Controllers\Admin\Products\UpdateController::class)->name('product.update');
        Route::post('/{product}/remove-image', App\Http\Controllers\Admin\Products\RemoveImageController::class)->name('products.removeImage');
        Route::delete('/{product}', App\Http\Controllers\Admin\Products\DestroyController::class)->name('products.destroy');
    });

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
