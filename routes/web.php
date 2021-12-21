<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PicturesController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\TransactionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'],)->group(function(){
    //User
    Route::resource('user', UsersController::class);
    //Pictures
    Route::resource('picture', PicturesController::class);
    //Events
    Route::resource('event', EventosController::class);
    //Events
    Route::resource('trans', TransactionsController::class);
});