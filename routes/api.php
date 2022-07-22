<?php

use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => ['auth:sanctum']
], function () {

    Route::group([
        'middleware' => 'is_admin',
    ], function () {
//        Route::apiResource('todolists', TodolistController::class);
        Route::get('/profile/{user}', [\App\Http\Controllers\ProfileController::class, 'profile']);
    }
    );

    Route::group([
    ],function (){
        Route::apiResource('todolists', TodolistController::class);

    });

});




