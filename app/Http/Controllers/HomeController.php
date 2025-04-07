<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Car;
use App\Models\User;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
       
        $cars = Car::where("published_at", "<", now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy("published_at", "desc")
            ->limit(30)
            ->get();

             $makers = Maker::with('models')->get();

        $models = Model::with('maker')->get();
        $years = Car::select("year")->orderBy("year", "desc")->distinct()->pluck("year");
        //now years will be array of years not object
        // $cartype = CarType::select("name")->orderBy("name", "asc")->distinct()->pluck("name");
        $cartypes = CarType::select("*")->orderBy("name", "asc")->distinct()->get();
        $fueltypes = FuelType::select("*")->orderBy("name", "asc")->distinct()->get();
        $states = State::select("*")->orderBy("name", "asc")->distinct()->get();
        $cities = City::select("*")->orderBy("name", "asc")->distinct()->get();
        
        // if (!Auth::check()) {
        //     return redirect()->route("login");
        // }
        $userId = session('userid');
       $user = User::find($userId);
      
$favouriteCarIds = $user ? $user->favouredCars()->pluck('cars.id')->toArray() : [];

        return view("home.index", ["cars" => $cars,  "makers" => $makers,
            "models" => $models,
            "years" => $years,
            "cartypes" => $cartypes,
            "fueltypes" => $fueltypes,
            "states" => $states,
            "cities" => $cities,
        "favouriteCarIds"=>$favouriteCarIds]);


       
    }
}
