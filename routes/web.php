<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;

Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/completion',[RegisteredUserController::class,'store']);



