<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home.index');
Route::get("/signup", [SignUpController::class, "create"])->name("auth.signup");
Route::get("/login", [LoginController::class, "create"])->name("auth.login");
