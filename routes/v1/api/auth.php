<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('sign-in', [AuthController::class, 'signIn'])->name('signIn');
    Route::post('sign-up', [AuthController::class, 'signUp'])->name('signUp');
});
