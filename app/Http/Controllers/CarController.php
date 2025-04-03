<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function show(Car $car)
    {
        return view("car.show", ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view("car.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
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