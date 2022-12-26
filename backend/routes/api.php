<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('list', [ProductController::class, 'ListProducts']);
        Route::get('get/{slug}', [ProductController::class, 'getProduct']);
    });
    Route::prefix('cart')->group(function () {
        Route::get('list', [CartController::class, 'ListCart']);
        Route::post('add', [CartController::class, 'AddToCart']);
        Route::delete('remove', [CartController::class, 'DeleteCart']);
        Route::put('update', [CartController::class, 'UpdateCart']);
    });
    Route::prefix('categories')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::user();
});
