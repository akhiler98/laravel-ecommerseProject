<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SamsungphoneController;
use App\Http\Controllers\ApplephoneController;
use App\Http\Controllers\Api\SignupController;
use App\Http\Controllers\Api\CartController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/samsung',[SamsungphoneController::class,'samsung']);
Route::get('/samsung/{id}',[SamsungphoneController::class,'findproduct']);

Route::get('/apple',[ApplephoneController::class,'apple']);

Route::post('/signup',[SignupController::class,'store']);

Route::post('/login',[SignupController::class,'check']);


Route::post('/cart',[CartController::class,'addToCart']);
Route::get('/cart/{userId}',[CartController::class,'findItemsInCart']);
Route::get('/cart/delete/{product_id}/user/{user_id}',[CartController::class,'delete']);