<?php

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

Route::prefix('admin')->group(function () {
   Route::get('/', App\Http\Controllers\Admin\IndexController::class)->name('admin.index');

   Route::prefix('categories')->group(function () {
       Route::get('/', App\Http\Controllers\Admin\Categories\IndexController::class)->name('categories.index');
       Route::get('/create', App\Http\Controllers\Admin\Categories\CreateController::class)->name('categories.create');
       Route::post('/', App\Http\Controllers\Admin\Categories\StoreController::class)->name('categories.store');
       Route::get('/categories/{category}', App\Http\Controllers\Admin\Categories\ShowController::class)->name('categories.show');
       Route::get('/categories/{category}/edit', App\Http\Controllers\Admin\Categories\EditController::class)->name('categories.edit');
       Route::patch('/categories/{category}', App\Http\Controllers\Admin\Categories\UpdateController::class)->name('categories.update');
       Route::delete('/categories/{category}', App\Http\Controllers\Admin\Categories\DestroyController::class)->name('categories.destroy');
   });

});
