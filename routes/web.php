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

Route::group(['middleware' => 'auth', 'role:admin'], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('role:admin');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'create'])->name('profile.create');
        Route::post('profile', [\App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

        Route::get('admins/data', [\App\Http\Controllers\AdminController::class, 'data'])->name('admins.data');
        Route::resource('admins', \App\Http\Controllers\AdminController::class);

        Route::get('users/data', [\App\Http\Controllers\UsersController::class, 'data'])->name('users.data');
        Route::get('users/{id}/products', [\App\Http\Controllers\UsersController::class, 'showUserProducts'])->name('users.show.products');
        Route::resource('users', \App\Http\Controllers\UsersController::class);

        Route::get('products/data', [\App\Http\Controllers\ProductController::class, 'data'])->name('products.data');
        Route::resource('products', \App\Http\Controllers\ProductController::class);
    });
});

Route::get('/generate',  [\App\Http\Controllers\DashboardController::class, 'generatePassword'])->name('generate-password');
Route::get('/reset-password-form/{token}',  [\App\Http\Controllers\Api\Auth\resetPasswordController::class, 'resetForm'])->name('password.reset.form');
Route::post('/reset-password',  [\App\Http\Controllers\Api\Auth\resetPasswordController::class, 'resetPassword'])->name('password.reset');

require __DIR__ . '/auth.php';
