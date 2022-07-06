<?php

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

Route::post('/article/store',[App\Http\Controllers\ArticleController::class,'store']);
Route::get('/article/{article}',[App\Http\Controllers\ArticleController::class,'show']);
Route::get('/article',[App\Http\Controllers\ArticleController::class,'index']);
Route::patch('/article/update/{article}',[\App\Http\Controllers\ArticleController::class,'update']);
Route::delete('/article/destroy/{article}',[\App\Http\Controllers\ArticleController::class,'destroy']);
