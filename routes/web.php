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




Route::match(['POST', 'GET'], '', [\App\Http\Controllers\AuthController::class,'index'])->name('login')->middleware('guest');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::prefix('user')->group(function (){
    Route::match(['POST','GET'],'', [\App\Http\Controllers\UserController::class,'index'])->name('user');
    Route::get('datatable', [\App\Http\Controllers\UserController::class,'datatable'])->name('user.datatable');
});

Route::prefix('item')->group(function (){
    Route::match(['POST','GET'],'', [\App\Http\Controllers\ItemController::class,'index'])->name('item');
    Route::get('datatable', [\App\Http\Controllers\ItemController::class,'datatable'])->name('item.datatable');
    Route::post('delete', [\App\Http\Controllers\ItemController::class,'delete'])->name('item.delete');
});

Route::prefix('category')->group(function (){
    Route::get('json', [\App\Http\Controllers\CategoryController::class,'json'])->name('category.json');
    Route::post('', [\App\Http\Controllers\CategoryController::class,'postData'])->name('category');
});

Route::prefix('transaction')->group(function (){
    Route::get('', [\App\Http\Controllers\TransactionController::class,'index'])->name('transaction');
    Route::get('datatable', [\App\Http\Controllers\TransactionController::class,'datatable'])->name('transaction.datatable');
    Route::prefix('{id}')->group(function (){
        Route::get('', [\App\Http\Controllers\TransactionController::class,'detail'])->name('transaction.detail');
        Route::get('datatable', [\App\Http\Controllers\TransactionController::class,'datatableCart'])->name('transaction.detail.datatable');
    });
});
