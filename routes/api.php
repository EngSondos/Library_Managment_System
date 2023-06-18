<?php

use App\Http\Controllers\BookApi;
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



Route::prefix('books')->group(function(){

    Route::get('',[BookApi::class,'index']);

    Route::delete('/{id}',[BookApi::class,'destroy']);
  

    Route::post('/search',[BookApi::class,'show']);

    Route::put('update/{id}',[BookApi::class,'update']);
});
Route::post('/store',[BookApi::class,'store']);

   


