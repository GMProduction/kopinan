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

Route::get('/', function () {
    return response()->json([
        'app_name' => 'masa_muda_coffe_app',
        'app_version' => 'v1.0'
    ], 200);
});

Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [\App\Http\Controllers\API\CategoryController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\API\CategoryController::class, 'findByID']);
    });

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [\App\Http\Controllers\API\ItemController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\API\ItemController::class, 'findByID']);
        Route::get('/{id}/category', [\App\Http\Controllers\API\ItemController::class, 'findByCategoryID']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::match(['post', 'get'], '/', [\App\Http\Controllers\API\CartController::class, 'index']);
        Route::post('/{id}/delete', [\App\Http\Controllers\API\CartController::class, 'deleteCart']);
        Route::post('/checkout', [\App\Http\Controllers\API\CartController::class, 'checkout']);
    });

    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/', [\App\Http\Controllers\API\TransactionController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\API\TransactionController::class, 'findByID']);
        Route::post('/{id}/payment', [\App\Http\Controllers\API\PaymentController::class, 'index']);
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\API\AuthController::class, 'getprofile']);
    });
});
