<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:3,1')->group(function () {
 Route::post('/register', [RegisteredUserController::class, 'store']);
 Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function () {
 Route::get('/user', function (Request $request) {
  return response()->json([
   'user' => $request->user(),
  ]);
 });
 Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
 Route::apiResource('students', StudentController::class);
});
