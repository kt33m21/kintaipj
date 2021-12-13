<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;

Route::get('/',[RegisteredUserController::class,'test']);
Route::get('/register',[RegisteredUserController::class,'create']);

