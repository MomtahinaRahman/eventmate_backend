<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Photography_serviceController;
use App\Http\Controllers\Photography_orderController;
use App\Http\Controllers\Music_serviceController;
use App\Http\Controllers\Music_orderController;
use App\Http\Controllers\Decoration_orderController;


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
    Route::resource('vendors', VendorController::class);

    //Route::post('/vendorstore',[VendorController::class,'store']);
    //Route::get('vendorindex',[VendorController::class,'index']);
    //Route::post('/vendorshow',[VendorController::class,'show']);
    //service store route
    Route::resource('services', ServiceController::class);
    //Route::post('servicestore',[ServiceController::class,'store']);
    //Route::get('serviceindex',[ServiceController::class,'index']);
    //review store route
    Route::resource('reviews', ReviewController::class);
    //Route::post('reviewstore',[ReviewController::class,'store']);
    //Route::get('reviewindex',[ReviewController::class,'index']);
    //event store route
    Route::resource('events', EventController::class);
    //Route::post('eventstore',[EventController::class,'store']);
    //Route::get('eventindex',[EventController::class,'index']);
    
    Route::resource('decoration_orders', Decoration_orderController::class);

    Route::resource('photography_services', Photography_serviceController::class);
    Route::resource('photography_orders', Photography_orderController::class);
    Route::resource('music_services', Music_serviceController::class);
    Route::resource('music_orders', Music_orderController::class);

});

