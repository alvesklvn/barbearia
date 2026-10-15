<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('register', function () {
        return view('register');
    });
    Route::post('register', [AuthController::class, 'register']);
    
    Route::get('login', function () {
        return view('login');
    });
    Route::post('login', [AuthController::class, 'login'])->middleware('web');
    
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['web', 'signed'])->name('verification.verify');
});