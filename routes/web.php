<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home.index');
// })->name('home.index');

Route::get("/", [HomeController::class, "index"])->name("home.index");
Route::get("/car/search", [CarController::class, "search"])->name("car.search");
// we need to put this route before resource because in car controller resource crud in case of edit show 
// the route will look same car/{car} so it will execure the above route as show route
Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist");
Route::resource("car", CarController::class);
Route::get("/signup", [SignUpController::class, "create"])->name("auth.signup");
Route::get("/login", [LoginController::class, "create"])->name("auth.login");