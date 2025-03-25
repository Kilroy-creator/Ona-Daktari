<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\LocationController;


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

route::get('/roles', [RolesController::class, 'createRole']);
route::get('/roles/{id}', [RolesController::class, 'getRole']);
route::post('/roles', [RolesController::class, 'createRole']);
route::put('/updateroles/{id}', [RolesController::class, 'updateRole']);
route::delete('/roles/{id}', [RolesController::class, 'deleteRole']);
Route::get('/roles', [RolesController::class, 'index']);
