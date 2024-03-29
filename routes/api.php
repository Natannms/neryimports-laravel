<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cart/prepare/{id}', CartController::class . '@createCart');
Route::post('/websocket/received',  function(){
    return response()->json([
        "message"=> "Received"
    ]);
});
