<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
//fetching all the route
Route::resource('product', ProductController::class);

//Public Route
Route::post('register', [AuthController::class,'register']);
Route::post('reg', [AuthController::class,'reg']);
Route::post('login', [AuthController::class,'login']);
Route::get('product', [ProductController::class,'index']);
Route::get('product/{id}', [ProductController::class,'show']);
Route::get('product/search/{name', [ProductController::class,'search']);
//Protected Routes
Route::group(['middleware'=>['auth:sanctum']],function(){
Route::post('/product', [ProductController::class,'store']);
Route::post('/product/{id}', [ProductController::class,'update']);
Route::post('/product/{id}', [ProductController::class,'destroy']);
Route::post('logout', [AuthController::class,'logout']);
});
// Route::group(['middleware'=>['auth:sanctum']], function () {
//     Route::get('product/search/{name}', [ProductController::class,'search']);
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

