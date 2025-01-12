<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\CheckTypeUser;

Route::group([
    'middleware' =>['auth' , 'check-type','last-active']
], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('store', StoreController::class);
    Route::get('cat/trash', [CategoryController::class, 'trash'])->name('cat.trash');
    Route::post('cat/restore/{id}', [CategoryController::class, 'restore'])->name('cat.restore');
    Route::delete('cat/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('cat.forceDelete');

    Route::get('prod/trash', [ProductController::class, 'trash'])->name('prod.trash');
    Route::post('prod/restore/{id}', [ProductController::class, 'restore'])->name('prod.restore');
    Route::delete('prod/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('prod.forceDelete');


    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');

});
