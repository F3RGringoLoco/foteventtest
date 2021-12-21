<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovilUsersController;
use App\Http\Controllers\MovilPicturesController;
use App\Http\Controllers\MovilTransactionsContoller;
use App\Http\Controllers\MovilEventsContoller;
use App\Http\Controllers\MovilPhotographersController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Rutas para acceder sin token
Route::post('/login', [MovilUsersController::class, 'login']);
Route::post('/register', [MovilUsersController::class, 'register']);

//Rutas de token valido
Route::group(['middleware' => 'jwt.auth'], function(){
    //User
    Route::post('/logout', [MovilUsersController::class, 'logout']);
    Route::get('/getauthuser', [MovilUsersController::class, 'getAuthenticatedUser']);

    //Pictures
    Route::get('/getpictures', [MovilPicturesController::class, 'getPictures']);

    //Transaction
    Route::post('/savetrans', [MovilTransactionsContoller::class, 'saveTransaction']);

    //Events
    Route::get('/getevents', [MovilEventsContoller::class, 'getMyEvents']);
    Route::get('/getfreeevents', [MovilEventsContoller::class, 'getMyFreeEvents']);
    Route::post('/saveevent', [MovilEventsContoller::class, 'saveEvent']);
    Route::post('/savephot', [MovilEventsContoller::class, 'saveEventPhot']);

    //Photographers
    Route::get('/getphotographers', [MovilPhotographersController::class, 'getPhotographers']);

    //Card
    Route::post('/savecard', [MovilUsersController::class, 'saveCard']);
});