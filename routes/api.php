<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Properties Routes
Route::middleware(['auth:sanctum', 'role:admin,landlord'])->group(function(){
    Route::get('properties', [PropertyController::class, 'index']);
    Route::post('properties', [PropertyController::class, 'store']);
    Route::get('properties/{property}', [PropertyController::class, 'show']);
    Route::put('properties/{property}', [PropertyController::class, 'update']);
    Route::delete('properties/{property}', [PropertyController::class, 'destroy']);
});

// Units Routes
Route::middleware(['auth:sanctum', 'role:admin,landlord'])->group(function () {
    Route::get('properties/{propertyId}/units', [UnitController::class, 'index']);
    Route::post('properties/{propertyId}/units', [UnitController::class, 'store']);
    Route::get('properties/{propertyId}/units/{unit}', [UnitController::class, 'show']);
    Route::put('properties/{propertyId}/units/{unit}', [UnitController::class, 'update']);
    Route::delete('properties/{propertyId}/units/{unit}', [UnitController::class, 'destroy']);
});

// Tenant Routes
Route::middleware(['auth:sanctum', 'role:admin,landlord'])->group(function () {
    Route::get('tenants', [TenantController::class, 'index']);
    Route::post('tenants', [TenantController::class, 'store']);
    Route::get('tenants/{tenant}', [TenantController::class, 'show']);
    Route::put('tenants/{tenant}', [TenantController::class, 'update']);
    Route::delete('tenants/{tenant}', [TenantController::class, 'destroy']);
});

// Leases Routes
Route::middleware(['auth:sanctum', 'role:admin,landlord'])->group(function () {
    Route::get('leases', [LeaseController::class, 'index']);
    Route::post('leases', [LeaseController::class, 'store']);
    Route::get('leases/{lease}', [LeaseController::class, 'show']);
    Route::put('leases/{lease}', [LeaseController::class, 'update']);
    Route::delete('leases/{lease}', [LeaseController::class, 'destroy']);
});

// Payment Routes
Route::middleware(['auth:sanctum', 'role:admin,agent,landlord'])->group(function () {
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::get('payments/{payment}', [PaymentController::class, 'show']);
    Route::put('payments/{payment}', [PaymentController::class, 'update']);
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy']);
});