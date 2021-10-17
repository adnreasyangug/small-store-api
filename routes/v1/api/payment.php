<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Payment\PaymentController;

Route::prefix('payment')->middleware(['auth:sanctum'])->group(function() {
    Route::post('make', [PaymentController::class,'makePayment'])->name('makePayment');
});
