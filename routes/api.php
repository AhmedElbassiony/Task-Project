<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('user/register/validation', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'userRegisterValidation']);
Route::post('user/register/email', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'emailRegister']);
Route::post('user/register/mobile', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'mobileRegister']);
Route::post('user/verifyOtp', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'verifyOTP']);
Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

Route::put('user/verify-user/{user}', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'verifyUser']);
Route::post('forgot-password', [\App\Http\Controllers\Api\Auth\resetPasswordController::class, 'sendResetLinkEmail']);
Route::get('mobile-validation', [\App\Http\Controllers\Api\Auth\resetPasswordController::class, 'validateMobile']);




Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::group(['middleware' => ['role:user|admin']], function () {

        Route::get('user', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::put('user/update', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::get('user/my-products' , [\App\Http\Controllers\Api\UserController::class , 'myProducts']);


//////////////////////////////////////////////Admin Role///////////////////////////////////////////////////////////////////////////////
        Route::post('products/assign-products',  [\App\Http\Controllers\Api\UserController::class, 'UserAssignProduct'])->middleware('role:admin');
        Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class)->except('show')->middleware('role:admin');
    });

    Route::post('logout', [\App\Http\Controllers\Api\Auth\LogoutController::class, 'logout']);

    Route::put('user/change-password', [\App\Http\Controllers\Api\Auth\resetPasswordController::class, 'changePassword']);
});
