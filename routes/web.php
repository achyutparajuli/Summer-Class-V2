<?php

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');



Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');


Route::prefix('admin/users')
    ->as('admin.users.')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{userId}', 'edit')->name('edit');
        Route::put('/{userId}', 'update')->name('update');
        Route::delete('/{userId}', 'delete')->name('delete');
    });
