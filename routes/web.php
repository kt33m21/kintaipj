<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;
use Illuminate\Http\Request;

//アカウント登録機能//
Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/completion',[RegisteredUserController::class,'store']);
//ログインフォーム//
Route::group(['middleware' => ['guest']], function () {
Route::get('/login',[LoginUserController::class,'login'])->name('login');
Route::post('/home',[LoginUserController::class,'execution']);
});
//ログイン・ログアウト機能//
Route::group(['middleware' => ['auth']], function () {
Route::get('/home',[LoginUserController::class,'top']);
Route::post('logout', [LoginUserController::class, 'logout'])->name('logout');
});

//勤務開始//
Route::post('/attendance/start', [AttendanceController::class, 'attendanceWork'])->name('/attendance/start');
//勤務終了//
Route::post('/attendance/end', [AttendanceController::class, 'leavingWork'])->name('/attendance/end');
//休憩開始//
Route::post('/attendance/reststart', [AttendanceController::class, 'reststartWork'])->name('/attendance/reststart');
//休憩終了//
Route::post('/attendance/restend', [AttendanceController::class, 'restendWork'])->name('/attendance/restend');

//Route::get('/attendance/attendance', [AttendanceController::class, 'AttendanceList'])->name('/attendance/attendance');//