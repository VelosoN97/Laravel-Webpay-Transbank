<?php

use App\Http\Controllers\TransbankController;
use Illuminate\Support\Facades\Route;

Route::get('/buy', [TransbankController::class, 'buy'])->name('buy');
Route::post('/pay', [TransbankController::class, 'pay'])->name('pay');


