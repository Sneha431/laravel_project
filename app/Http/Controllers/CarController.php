<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\Maker;
use App\Models\Model;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request, request());
        $cars = User::find(1)
            ->cars()
            ->with(['primaryImage',  'maker', 'model'])
            ->orderBy("created_at", "desc")
            //->get();
            ->paginate(5);
        //->appends(["sort" => "price"]); //http://127.0.0.1:8000/car?sort=price&page=1
        //->withPath("/user/cars");
        // ->simplePaginate(5);
        //   ->withQueryString(); //http://127.0.0.1:8000/car?sort=price&name=abc&page=4
        // ->fragment('cars'); //http://127.0.0.1:8000/car?page=3#cars

        //2. simplePaginate() Features:
        // ✅ Uses only one SQL query (better for large datasets)
        // ✅ Faster because it does not count total records ❌ 
        //Does not support onEachSide(n) (no total pages) 
        //❌ No jumping to specific pages (only Next/Previous links)
        return view("car.index", ["cars" => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("car.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Car $car)
    {
        //req url = http://127.0.0.1:8000/car/1?page=1

        // dd($request->path()); //Output: "car/1"
        // dd($request->url()); //output : "http://127.0.0.1:8000/car/1"
        //dd($request->fullUrl()); //output :"http://127.0.0.1:8000/car/1?page=1"
        // dd($request->method()); //output :GET

        // if ($request->isMethod('get')) {
        //     dd("get");
        // }
        // if ($request->isXmlHttpRequest()) {
        //     dd("isXmlHttpRequest");
        // }
        // if ($request->is("admin/*")) {
        //     //pattern matches with "admin/*"
        //     dd("Admin");
        // }
        // if ($request->routeIs("admin.*")) {
        //     //pattern matches with route name starts with "admin"
        //     dd("Admin");
        // }
        // if ($request->expectsJson()) {
        //     dd("json");
        // }
        // dd($request->fullUrlWithQuery(["sort" => "price"]));
        //output : "http://127.0.0.1:8000/car/1?page=1&sort=price"

        //dd($request->fullUrlWithoutQuery(['page'])); //"http://127.0.0.1:8000/car/1"
        //dd($request->host()); //"127.0.0.1"
        // dd($request->httpHost()); //"127.0.0.1:8000"
        //dd($request->schemeAndHttpHost()); //"http://127.0.0.1:8000"
        // dd($request->header('Content-Type')); //output : "application/json" //null /
        // dd($request->bearerToken()); //null
        // dd($request->ip()); //"127.0.0.1"
        return view("car.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        // $maker = $car->maker;
        // $model = $car->model;
        $makers = Maker::with('models')->get();

        $models = Model::with('maker')->get();
        $years = Car::select("year")->orderBy("year", "desc")->distinct()->pluck("year");
        //now years will be array of years not object
        // $cartype = CarType::select("name")->orderBy("name", "asc")->distinct()->pluck("name");
        $cartypes = CarType::select("*")->orderBy("name", "asc")->distinct()->get();
        $fueltypes = FuelType::select("*")->orderBy("name", "asc")->distinct()->get();
        $states = State::select("*")->orderBy("name", "asc")->distinct()->get();
        $cities = City::select("*")->orderBy("name", "asc")->distinct()->get();
        $carfeatures = CarFeatures::select("*")->where("car_id", $car->id)->get()->toArray();
        // dd($carfeatures[0]['car_id']);
        // $city_state = $car->city->state_id;

        // dd($city_state, $car->city_id);
        return view("car.edit", [
            "car" => $car,
            "makers" => $makers,
            "models" => $models,
            "years" => $years,
            "cartypes" => $cartypes,
            "fueltypes" => $fueltypes,
            "states" => $states,
            "cities" => $cities,
            "carfeatures" => $carfeatures,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {

        $rules = [
            "maker_id" => "required",
            "model_id" => "required",
            "year" => "required|integer|min:1900|max:" . date("Y"),
            "mileage" => "required|numeric|min:0|max:1000000",
            "vin" => "required|string|size:17",
            "address" => "required|string|max:255",
            "phone" => "required|string|max:15",
            "car_type_id" => "required",
            "fuel_type_id" => "required",
            "city_id" => "required",

            "price" => "required|numeric|min:0|max:10000000",
            "description" => "nullable|string|max:1000",
        ];



        $validator = Validator::make($request->all(), $rules);
        // dd($validator->errors());
        if ($validator->fails()) {
            return redirect()->route("car.edit", $car->id)->withInput()->withErrors($validator);
        }


        $car = Car::find($car->id);
        $car->maker_id = $request->maker_id;
        $car->model_id = $request->model_id;
        $car->year = $request->year;
        $car->mileage = $request->mileage;
        $car->vin = $request->vin;
        $car->address = $request->address;
        $car->phone = $request->phone;
        $car->car_type_id = $request->car_type_id;
        $car->fuel_type_id = $request->fuel_type_id;
        $car->city_id = $request->city_id;
        $car->city->state_id = $request->state_id;
        $car->price = $request->price;
        $car->description = $request->description;
        $car->published_at =  $request->published_at == "1" ? now() : null;
        $car->updated_at = now();
        $car->save();

        // // Ensure the car features exist
        if (!$car->features) {
            $car->features()->create([]); // Create an empty feature record if none exists
        }


        // Update features
        $car->features->abs = (int)$request->abs;
        $car->features->air_conditioning = (int)$request->air_conditioning;
        $car->features->power_windows = (int)$request->power_windows;
        $car->features->power_door_locks = (int)$request->power_door_locks;
        $car->features->cruise_control = (int)$request->cruise_control;
        $car->features->bluetooth_connectivity = (int)$request->bluetooth_connectivity;
        $car->features->remote_start = (int)$request->remote_start;
        $car->features->gps_navigation = (int)$request->gps_navigation;
        $car->features->heater_seats = (int)$request->heater_seats;
        $car->features->climate_control = (int)$request->climate_control;
        $car->features->rear_parking_sensors = (int)$request->rear_parking_sensors;
        $car->features->leather_seats = (int)$request->leather_seats;


        $car->features->save(); // Save features separately

        return redirect()->route("car.edit", $car->id)->with("success", "Car updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
    public function search()
    {
        //inner join
        // $query = Car::where("published_at", "<", now())
        //     ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
        //     ->orderBy("published_at", "desc");
        // $query->join("cities", "cities.id", "=", "cars.city_id")
        //     ->join("car_types", "car_types.id", "=", "cars.car_type_id")
        //     ->where("cities.state_id", 3)
        //     ->where("car_types.name", "Sedan");
        // $query->select("cars.*", "cities.name as city_name");

        //inner join
        //select("cars.*") this will hide state_id and name ..only cars data will show
        // $query = Car::select("cars.*")->where("published_at", "<", now())
        //     ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
        //     ->orderBy("published_at", "desc");
        // $query->join("cities", "cities.id", "=", "cars.city_id")
        //     ->join("car_types", "car_types.id", "=", "cars.car_type_id")
        //     ->where("cities.state_id", 3)
        //     ->where("car_types.name", "Sedan");
        //  $query->select("cars.*", "cities.name as city_name");


        //left join

        // $query = Car::select("cars.*")->where("published_at", "<", now())
        //     ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
        //     ->orderBy("published_at", "desc");
        // $query->leftJoin("cities", "cities.id", "=", "cars.city_id")
        //     ->leftJoin("car_types", "car_types.id", "=", "cars.car_type_id")
        //     ->where("cities.state_id", 3)
        //     ->where("car_types.name", "Sedan");
        // $query->select("cars.*", "cities.name as city_name");



        // $cars = $query->limit(30)->get();
        // $carCount = $query->count();
        // return view(
        //     "car.search",
        //     ["cars" => $cars, 'carCount' => $carCount]
        // );

        $query = Car::where("published_at", "<", now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy("published_at", "desc");
        $cars = $query->paginate(15);

        return view(
            "car.search",
            ["cars" => $cars]
        );
    }

    public function watchlist()
    {
        $cars = User::find(4)
            ->favouredCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(15);
        //->get();
        return view("car.watchlist", ["cars" => $cars]);
    }
}