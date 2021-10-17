<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;

Route::prefix('users')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
    Route::post('', [UserController::class, 'create'])->name('create');
    Route::get('{user:id}', [UserController::class, 'show'])->name('show');
    Route::get('{user:id}/payments', [UserController::class, 'payments'])->name('payments');
    Route::put('{user:id}', [UserController::class, 'edit'])->name('edit');
    Route::delete('{user:id}', [UserController::class, 'delete'])->name('delete');
});
