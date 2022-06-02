<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/posts',[PostController::class,'index']);
Route::post('/posts',[PostController::class,'createOrUpdate']);
Route::get('/posts/{id}',[PostController::class,'read']);
Route::patch('/posts/{id}',[PostController::class,'update']);
Route::delete('/posts/{id}',[PostController::class,'delete']);

Route::apiResource('form',FormController::class);



// Route::api

Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/signin', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
});

