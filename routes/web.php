<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use Illuminate\Http\Request;

Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/completion',[RegisteredUserController::class,'store']);
Route::get('/login',[LoginUserController::class,'login']);
Route::post('/home',[LoginUserController::class,'execution']);