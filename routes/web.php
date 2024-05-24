<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login'])->middleware(ThrottleRequests::using('login'));
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/save/{taskId}', [TaskController::class, 'save']);
Route::get('/delete/{taskId}', [TaskController::class, 'delete']);
Route::get('/view/{taskId}', [TaskController::class, 'view']);
Route::get('/edit/{taskId?}', [TaskController::class, 'form']);
Route::get('/own/{hideCompleted?}', [TaskController::class, 'own']);
Route::get('/wrote/{hideCompleted?}', [TaskController::class, 'wrote']);
Route::get('/{hideCompleted?}', [TaskController::class, 'list']);

