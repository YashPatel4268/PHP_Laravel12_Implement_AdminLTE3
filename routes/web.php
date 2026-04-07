<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;

Auth::routes(); //
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

