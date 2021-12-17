<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Http\Request;

Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/completion',[RegisteredUserController::class,'store']);



