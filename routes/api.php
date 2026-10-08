<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login'])->middleware('web');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['web', 'signed'])->name('verification.verify');
});