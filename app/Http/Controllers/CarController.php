<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\Maker;
use App\Models\Model;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request, request());
        $userid = session('userid');
        $cars = User::find($userid)
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
        $carfeatures = CarFeatures::select("*")->get()->toArray();
        // dd($carfeatures[0]['car_id']);
        // $city_state = $car->city->state_id;

        // dd($city_state, $car->city_id);
        return view("car.create", [

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
    public function store(Request $request)
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
            "image_path" => "required|image|mimes:jpeg,png,jpg,gif|max:2048"
        ];
        $customAttributes = [
            'maker_id' => 'maker',
            'model_id' => 'model',
            'car_type_id' => 'car type',
            'fuel_type_id' => 'fuel type',
            'city_id' => 'city',
            'vin' => 'VIN',
            'mileage' => 'mileage',
            'year' => 'year',
            'address' => 'address',
            'phone' => 'phone number',
            'price' => 'price',
            'description' => 'description',
            'image_path' => 'image',
        ];
        // $validator = Validator::make($request->all(), $rules);
        $validator = Validator::make($request->all(), $rules, [], $customAttributes);
        if ($validator->fails()) {
            return redirect()->route("car.create")->withInput()->withErrors($validator);
        }
        $userid = session('userid');
        $car = new Car();
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
        $car->price = $request->price;
        $car->description = $request->description;
        $car->published_at =  $request->published_at == "1" ? now() : null;
        $car->user_id =   $userid;
        $car->created_at = now();
        $car->save();

        // ✅ Save all uploaded images
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . "_" . uniqid() . "." . $ext;
                $image->move(public_path('uploads/cars'), $imageName);

                $pos = CarImage::where('car_id', $car->id)->max('position');
                $pos = $pos ? $pos + 1 : 1;

                $car->images()->create([
                    'image_path' => $imageName,
                    'position' => $pos,
                ]);
            }
        }

        // ✅ Create or update car features
        $features = $car->features()->firstOrCreate([]);
        $features->abs = (int)$request->abs;
        $features->air_conditioning = (int)$request->air_conditioning;
        $features->power_windows = (int)$request->power_windows;
        $features->power_door_locks = (int)$request->power_door_locks;
        $features->cruise_control = (int)$request->cruise_control;
        $features->bluetooth_connectivity = (int)$request->bluetooth_connectivity;
        $features->remote_start = (int)$request->remote_start;
        $features->gps_navigation = (int)$request->gps_navigation;
        $features->heater_seats = (int)$request->heater_seats;
        $features->climate_control = (int)$request->climate_control;
        $features->rear_parking_sensors = (int)$request->rear_parking_sensors;
        $features->leather_seats = (int)$request->leather_seats;
        $features->save();

        return redirect()->route("car.create")->with("success", "Car created successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    //     // dd($request->all());
    //     $rules = [
    //         "maker_id" => "required",
    //         "model_id" => "required",
    //         "year" => "required|integer|min:1900|max:" . date("Y"),
    //         "mileage" => "required|numeric|min:0|max:1000000",
    //         "vin" => "required|string|size:17",
    //         "address" => "required|string|max:255",
    //         "phone" => "required|string|max:15",
    //         "car_type_id" => "required",
    //         "fuel_type_id" => "required",
    //         "city_id" => "required",

    //         "price" => "required|numeric|min:0|max:10000000",
    //         "description" => "nullable|string|max:1000",
    //     ];



    //     $validator = Validator::make($request->all(), $rules);
    //     // dd($validator->errors());
    //     if ($validator->fails()) {
    //         return redirect()->route("car.create")->withInput()->withErrors($validator);
    //     }

    //     $car = new Car();
    //     $car->maker_id = $request->maker_id;
    //     $car->model_id = $request->model_id;
    //     $car->year = $request->year;
    //     $car->mileage = $request->mileage;
    //     $car->vin = $request->vin;
    //     $car->address = $request->address;
    //     $car->phone = $request->phone;
    //     $car->car_type_id = $request->car_type_id;
    //     $car->fuel_type_id = $request->fuel_type_id;
    //     $car->city_id = $request->city_id;

    //     $car->price = $request->price;
    //     $car->description = $request->description;
    //     $car->published_at =  $request->published_at == "1" ? now() : null;
    //     $car->user_id = 1; // Assuming the user ID is 1 for this example

    //     $car->created_at = now();



    //     if ($car->save()) {
    //         if ($request->image_path) {


    //             foreach ($request->file('image_path') as $image) {
    //                 $ext = $image->getClientOriginalExtension();
    //                 $imageName = time() . "_" . uniqid() . "." . $ext;
    //                 $image->move(public_path('uploads/cars'), $imageName);
    //                 $pos = CarImage::where('car_id', $car->id)->select('position')->max('position');
    //                 $pos = $pos ? $pos + 1 : 1; // Increment position or set to 1 if no images exist


    //                 $car->primaryImage()->create([
    //                     'image_path' => $imageName,
    //                     'position' => $pos
    //                 ]);

    //                 if ($car->primaryImage->save()) {
    //                     if (!$car->features) {
    //                         $car->features()->create([]); // Create an empty feature record if none exists
    //                     }
    //                     $features = $car->features()->firstOrCreate([]);

    //                     $features->abs = (int)$request->abs;
    //                     $features->air_conditioning = (int)$request->air_conditioning;
    //                     $features->power_windows = (int)$request->power_windows;
    //                     $features->power_door_locks = (int)$request->power_door_locks;
    //                     $features->cruise_control = (int)$request->cruise_control;
    //                     $features->bluetooth_connectivity = (int)$request->bluetooth_connectivity;
    //                     $features->remote_start = (int)$request->remote_start;
    //                     $features->gps_navigation = (int)$request->gps_navigation;
    //                     $features->heater_seats = (int)$request->heater_seats;
    //                     $features->climate_control = (int)$request->climate_control;
    //                     $features->rear_parking_sensors = (int)$request->rear_parking_sensors;
    //                     $features->leather_seats = (int)$request->leather_seats;

    //                     $features->save();
    //                     return redirect()->route("car.create")->with("success", "Car updated successfully");
    //                 }
    //             }
    //         }
    //         // Ensure the car features exist

    //     }
    // }

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

        $images = $car->images()->orderBy("position", "asc")->distinct()->get();

        return view("car.show", ["car" => $car, "images" => $images]);
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
        $images = $car->images()->distinct()->get();
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
            "images" => $images
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
          //  "image_path" => "required|image|mimes:jpeg,png,jpg,gif|max:2048"
        ];
        $customAttributes = [
            'maker_id' => 'maker',
            'model_id' => 'model',
            'car_type_id' => 'car type',
            'fuel_type_id' => 'fuel type',
            'city_id' => 'city',
            'vin' => 'VIN',
            'mileage' => 'mileage',
            'year' => 'year',
            'address' => 'address',
            'phone' => 'phone number',
            'price' => 'price',
            'description' => 'description',
           // 'image_path' => 'image',
        ];
        // $validator = Validator::make($request->all(), $rules);
        $validator = Validator::make($request->all(), $rules, [], $customAttributes);
        if ($validator->fails()) {
            return redirect()->route("car.edit", $car->id)->withInput()->withErrors($validator);
        }
        // dd($validator->errors());



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
        // $car->city->state_id = $request->state_id;
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
    public function editimages(Car $car)
    {
        $images = CarImage::select("*")->where("car_id", $car->id)->distinct()->orderBy("position", "asc")->get();


        return view("car.car_image", ["images" => $images, "car" => $car]);
    }

    public function updateimages(Request $request, Car $car)
    {
        foreach ($request->id as $key => $rid) {
            $carimage = CarImage::find($rid);
            if (!$carimage) continue;

            // If this image's ID is in the delete_images array
            if (in_array($rid, $request->delete_images ?? [])) {
                // Delete image (and optionally its file)
                $imagePath = public_path('uploads/cars/' . $carimage->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $carimage->delete();
            } else {
                // Update position
                $carimage->position = $request->position[$key];
                $carimage->save();
            }
        }
        return redirect()->route("car.editimages", $car)->with("success", "Car images updated / deleted successfully");
    }

    public function addimages(Request $request, Car $car)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . "_" . uniqid() . "." . $ext;
                $image->move(public_path('uploads/cars'), $imageName);

                $pos = CarImage::where('car_id', $car->id)->max('position');
                $pos = $pos ? $pos + 1 : 1;

                $car->images()->create([
                    'image_path' => $imageName,
                    'position' => $pos,
                ]);
            }
        }
        return redirect()->route("car.editimages", $car)->with("success", "Car images added successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function delete(Car $car)
    {
        //
        $car = Car::find($car->id);
        $car->delete();
        return redirect()->route("car.index")->with("success", "Car deleted successfully");
    }
    public function search(Request $request)
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

        // $query = Car::where("published_at", "<", now())
        //     ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
        //     ->orderBy("published_at", "desc");
        // $cars = $query->paginate(15);

        
// $query = Car::select("cars.*")
//     ->join("cities", "cities.id", "=", "cars.city_id")
//     ->join("car_types", "car_types.id", "=", "cars.car_type_id")
//     ->join("fuel_types", "fuel_types.id", "=", "cars.fuel_type_id")
//     ->join("models", "models.id", "=", "cars.model_id")
//     ->join("makers", "makers.id", "=", "cars.maker_id")
//     ->where("cars.published_at", "<", now())
//              ->where("year",$request->year);
             
// $cars = $query->paginate(15);
// DB::enableQueryLog();

$sortOrder = in_array($request->priceorder, ['asc', 'desc']) ? $request->priceorder : 'asc';
if($request->priceorder != null)
{
    $cars = Car::orderBy('cars.price', $sortOrder)->paginate(15);
}
else{
    $cars = Car::select("cars.*")
        ->join("cities", "cities.id", "=", "cars.city_id")
        ->join("car_types", "car_types.id", "=", "cars.car_type_id")
        ->join("fuel_types", "fuel_types.id", "=", "cars.fuel_type_id")
        ->join("models", "models.id", "=", "cars.model_id")
        ->join("makers", "makers.id", "=", "cars.maker_id")
        ->when($request->maker_id, fn($q) => $q->where("cars.maker_id", $request->maker_id))
        ->when($request->model_id, fn($q) => $q->where("cars.model_id", $request->model_id))
        ->when($request->state_id, fn($q) => $q->where("cities.state_id", $request->state_id))
        ->when($request->city_id, fn($q) => $q->where("cars.city_id", $request->city_id))
        ->when($request->car_type_id, fn($q) => $q->where("cars.car_type_id", $request->car_type_id))
        ->when($request->fuel_type_id, fn($q) => $q->where("cars.fuel_type_id", $request->fuel_type_id))
        // Year range filtering
    ->when($request->year_from, fn($q) => $q->where("cars.year", ">=", $request->year_from))
    ->when($request->year_to, fn($q) => $q->where("cars.year", "<=", $request->year_to))

    // Price range filtering
    ->when($request->price_from, fn($q) => $q->where("cars.price", ">=", $request->price_from))
    ->when($request->price_to, fn($q) => $q->where("cars.price", "<=", $request->price_to))
->when($request->mileage,fn($q)=>$q->where("cars.mileage","<=",$request->mileage))
        ->where("cars.published_at", "<", now())
        ->orderBy("cars.published_at", "desc")
   
        ->with(['primaryImage']) // eager load any relationships if needed
        ->paginate(15);
}



// dd(DB::getQueryLog());

//select all car details

$makers = Maker::with('models')->get();

        $models = Model::with('maker')->get();
        $years = Car::select("year")->orderBy("year", "desc")->distinct()->pluck("year");
      
        $cartypes = CarType::select("*")->orderBy("name", "asc")->distinct()->get();
        $fueltypes = FuelType::select("*")->orderBy("name", "asc")->distinct()->get();
        $states = State::select("*")->orderBy("name", "asc")->distinct()->get();
        $cities = City::select("*")->orderBy("name", "asc")->distinct()->get();
      //   $images = CarImage::all("image_path")->pluck("image_path");
     $mileages=Car::pluck('mileage')->unique()->sort()->values();
  

 
    
if ($cars->isNotEmpty())
 {
    session()->flash('success', 'Cars Fetched Successfully');
    return view(
            "car.search",
            ["cars" => $cars, "makers" => $makers,
            "models" => $models,
            "years" => $years,
            "cartypes" => $cartypes,
            "fueltypes" => $fueltypes,
            "states" => $states,
            "cities" => $cities,
            "mileages"=>$mileages
            
          ]
    );
 }
 else{
     session()->flash("error","No cars found with the given data");
    return view(
            "car.search",
            ["cars" => $cars,"makers" => $makers,
            "models" => $models,
            "years" => $years,
            "cartypes" => $cartypes,
            "fueltypes" => $fueltypes,
            "states" => $states,
            "cities" => $cities,
            "mileages"=>$mileages
            
          ]
        );
 }     
      
    }
public function addtowatchlist(Request $request)
{
    $carId = $request->car_id_fav;
    $userId = session('userid');

    // Fetch the user
    $user = User::find($userId);

    if (!$user) {
        session()->flash('error', 'User value: not found');
       return view("car.watchlist");
    }

    $exists= $user->favouredCars()->where('car_id', $carId)->exists();

    if($exists)
    {
        session()->flash('success', 'Car removed from watchlist');
          $user->favouredCars()->detach([$carId]);
    }
else{
 // Add car to favourites (won't duplicate due to syncWithoutDetaching)
 session()->flash('success', 'Car added to watchlist');
    $user->favouredCars()->syncWithoutDetaching([$carId]);
}
   
 $cars = User::find($userId)
            ->favouredCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(15);
            return view("car.watchlist", [
        'cars' => $cars
    ]);
// $prevurl = url()->previous();

// if (Str::is(url('/'), $prevurl)) {
//     return redirect()->route("home.index", [
//         'cars' => $cars
//     ]);
// } elseif (Str::contains($prevurl, '/car/watchlist')) {
//     return view("car.watchlist", [
//         'cars' => $cars
//     ]);
// }
    }

   



    public function watchlist()
    {
        $userid = session('userid');
        $cars = User::find($userid)
            ->favouredCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(15);
        //->get();
        return view("car.watchlist", ["cars" => $cars,"watchlisted"=>true]);
    }
}
