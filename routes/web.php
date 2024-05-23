<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

Route::get('/{hideCompleted?}', [TaskController::class, 'index']);
Route::get('/', [TaskController::class, 'index']);
Route::get('/view/{taskId?}', [TaskController::class, 'form']);
Route::post('/save/{taskId}', [TaskController::class, 'save']);
Route::get('/delete/{taskId}', [TaskController::class, 'delete']);

Route::post('/login', [AuthController::class, 'login'])->middleware(ThrottleRequests::using('login'));
Route::get('/logout', [AuthController::class, 'logout']);

