<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::middleware('checkRole:super Admin')->prefix('users')->group(function(){
        Route::get('/', [UserController::class,"index"]);
        Route::get('/{id}', [UserController::class,"show"]);
        Route::post('/', [UserController::class,"store"]);
        Route::put('/{id}', [UserController::class,"update"]);
        Route::delete('/{id}', [UserController::class,"destroy"]);
        });
    Route::middleware('checkRole:super Admin,Admin')->group(function(){
        Route::prefix('authors')->group(function(){
            Route::post('/', [AuthorController::class, 'store']);
            Route::get('/{id}', [AuthorController::class, 'show']);
            Route::put('/{id}', [AuthorController::class, 'update']);
            Route::delete('/{id}', [AuthorController::class, 'destroy']);
        });
        Route::Apiresource('category', CategoryController::class)->except('index');

    });
});

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);










Route::prefix('books')->group(function(){

    Route::delete('/{id}',[BookApi::class,'destroy']);
    Route::put('/{id}',[BookApi::class,'update']);
    Route::post('/',[BookApi::class,'store']);

});
Route::get('books',[BookApi::class,'index']);
Route::post('/search',[BookApi::class,'show']);


