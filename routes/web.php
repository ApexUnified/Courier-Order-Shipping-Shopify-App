<?php

use App\Http\Controllers\OrderFetchController;
use Illuminate\Support\Facades\Route;

Route::middleware(["verify.shopify"])->group(function () {

    Route::get('/', [OrderFetchController::class, "index"])->name("home");
    Route::post('/send-order', [OrderFetchController::class, "OrderSend"])->name("order.send");
});
