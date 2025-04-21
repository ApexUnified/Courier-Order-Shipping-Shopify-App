<?php

use App\Http\Controllers\OrderFetchController;
use Illuminate\Support\Facades\Route;


Route::get('/', [OrderFetchController::class, "index"])->middleware(["verify.shopify"])->name("home");
Route::post('/send-order', [OrderFetchController::class, "OrderSend"])->name("order.send");
