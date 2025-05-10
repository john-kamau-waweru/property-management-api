<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'landlord'])->group(function(){
    Route::get('properties', [PropertyController::class, 'index']);
    Route::post('properties', [PropertyController::class, 'store']);
    Route::get('properties/{property}', [PropertyController::class, 'show']);
    Route::put('properties/{property}', [PropertyController::class, 'update']);
    Route::delete('properties/{property}', [PropertyController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'landlord'])->group(function () {
    // Unit Routes under a specific Property
    Route::get('properties/{propertyId}/units', [UnitController::class, 'index']);
    Route::post('properties/{propertyId}/units', [UnitController::class, 'store']);
    Route::get('properties/{propertyId}/units/{unit}', [UnitController::class, 'show']);
    Route::put('properties/{propertyId}/units/{unit}', [UnitController::class, 'update']);
    Route::delete('properties/{propertyId}/units/{unit}', [UnitController::class, 'destroy']);
});