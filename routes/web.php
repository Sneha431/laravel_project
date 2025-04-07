<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;


Route::get("/signup", [SignUpController::class, "signup"])->name("signup");


Route::get("/login", [LoginController::class, "login"])->name("login");
Route::get("logout", [LoginController::class, "logout"])->name("logout");
Route::get("/reset", [LoginController::class, "reset"])->name("password.reset");
Route::put("/passwordedit", [LoginController::class, "passwordedit"])->name("password.edit");
Route::post("/login", [LoginController::class, "loginpost"])->name("login.post");
Route::post("/register", [SignUpController::class, "registeruser"])->name("register");
Route::get("/", [HomeController::class, "index"])->name("home.index");
// Route::get('/', function () {
//     return view('home.index');
// })->name('home.index');
Route::middleware(["auth"])->group(
  function () {

    Route::post("/car/search", [CarController::class, "search"])->name("car.search");
    
     Route::post("/car/favourite", [CarController::class, "favourite"])->name("cars.favourite");
  //   Route::get("/car/search", [CarController::class, "search"])->name("car.search");
    Route::get("/car/images/edit/{car}", [CarController::class, "editimages"])->name("car.editimages");
    Route::post("/car/images/add/{car}", [CarController::class, "addimages"])->name("car.addimages");
    Route::post("/car/update/images/{car}", [CarController::class, "updateimages"])->name("car.updateimages");
    Route::post("/car/store", [CarController::class, "store"])->name("car.store");
    Route::put("/car/update/{car}", [CarController::class, "update"])->name("car.update");
    Route::delete("/car/delete/{car}", [CarController::class, "delete"])->name("car.delete");
    // we need to put this route before resource because in car controller resource crud in case of edit show 
    // the route will look same car/{car} so it will execure the above route as show route
     Route::post("/car/addtowatchlist", [CarController::class, "addtowatchlist"])->name("cars.addtowatchlist");
    Route::get("/car/watchlist", [CarController::class, "watchlist"])->name("car.watchlist");
    Route::resource("car", CarController::class);
  }
);
