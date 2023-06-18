<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/',[BookController::class,'showbooks'])->name('main');

Route::prefix('books')->group(function(){

    Route::get('',[BookController::class,'index'])->name('ViewBooks');

    Route::get('/{id}',[BookController::class,'destroy'])->name('DeleteBook');
  
});

    Route::get('/create',[BookController::class,'create'])->name('AddBook');

    // Route::post('/store',[BookController::class,'store'])->name('StoreBook');

    Route::post('/search',[BookController::class,'show'])->name('SearchBook');

    Route::post('/Homesearch',[BookController::class,'showhome'])->name('SearchBookHome');


    Route::get('Edit/{id}',[BookController::class,'edit'])->name('EditBook');

    Route::post('Update/{id}',[BookController::class,'update'])->name('UpdateBook');






    // Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
