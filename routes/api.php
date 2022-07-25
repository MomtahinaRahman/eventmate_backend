<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EventController;


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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('signup', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
Route::middleware('auth:api')->post('/logout',[UserController::class,('logout')])->name('logout');

Route::middleware('auth:api')->group(function(){
    Route::get('user',[UserController::class,'userDetail']);

    //vendor store route
    Route::post('/vendorstore',[VendorController::class,'store']);
    Route::get('vendorindex',[VendorController::class,'index']);
    //service store route
    Route::post('servicestore',[ServiceController::class,'store']);
    Route::get('serviceindex',[ServiceController::class,'index']);
    //review store route
    Route::post('reviewstore',[ReviewController::class,'store']);
    Route::get('reviewindex',[ReviewController::class,'index']);
    //event store route
    Route::post('eventstore',[EventController::class,'store']);
    Route::get('eventindex',[EventController::class,'index']);


});

