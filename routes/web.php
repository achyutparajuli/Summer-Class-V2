<?php

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


Route::prefix('admin')->as('admin.')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login.index');
        Route::post('/login', 'check')->name('login.check');
    });
});

Route::prefix('admin')->middleware(UserMiddleware::class)->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('users')->as('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{userId}', 'edit')->name('edit');
        Route::put('/{userId}', 'update')->name('update');
        Route::delete('/{userId}', 'delete')->name('delete');
    });
});
