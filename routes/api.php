<?php

use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('todolists' , TodolistController::class);

Route::get('/profile/{user}',[\App\Http\Controllers\ProfileController::class,'profile']);


