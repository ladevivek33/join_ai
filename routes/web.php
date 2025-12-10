<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Redirect root to user login
Route::get('/', function () {
    return redirect()->route('user.login');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/alogin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/alogin', [AuthController::class, 'adminLogin'])->name('admin.login.post');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/users/{id}', [AuthController::class, 'showUser'])->name('admin.user.show');

        // Product Routes
        Route::get('/add-product', [\App\Http\Controllers\ProductController::class, 'showAddForm'])->name('admin.product.create');
        Route::post('/add-product', [\App\Http\Controllers\ProductController::class, 'store'])->name('admin.product.store');
        Route::delete('/product/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.product.delete');

        // Request Routes
        Route::delete('/request/{id}', [AuthController::class, 'deleteRequest'])->name('admin.request.delete');

        Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
    });
});

// User Routes
Route::get('/register', [UserController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserController::class, 'register'])->name('user.register.post');

Route::get('/login', [UserController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.post');

// Protected user routes
Route::middleware('user.auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/request-product', [UserController::class, 'requestProduct'])->name('user.request.product');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

