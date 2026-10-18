<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('register', function () {
        return view('register');
    });
    
    Route::post('register', [AuthController::class, 'register']);
    
    Route::get('login', function () {
        return view('login');
    });

    Route::post('login', [AuthController::class, 'login']);
    
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware('signed')->name('verification.verify');

    Route::delete('logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->regenerate();
        return response()->json(["deslogado com sucesso"]);
    })->middleware('auth:sanctum');
});

Route::prefix('services')->group(function () {
    Route::post('store', [ServiceController::class, 'store'])->middleware(['auth:sanctum', 'isBarber']);

    Route::delete('/{service}/delete', [ServiceController::class, 'destroy'])->middleware(['auth:sanctum', 'isBarber']);
});

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentsController::class, 'index'])->middleware(['auth:sanctum', 'isBarber']);
    Route::post('store', [AppointmentsController::class, 'store'])->middleware('auth:sanctum');
    Route::delete('{appointment}/delete', [AppointmentsController::class, 'destroy'])->middleware(['auth:sanctum', 'isAppointmentStakeholder']);
});