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
        //select all cars
        //$car = Car::get();
        //select published car
        //$car = Car::where("published_at", "!=>", null)->get();
        //select first car
        //$car = Car::where("published_at", "!=>", null)->first();
        //find car with specific id

        //$car = Car::find(2);
        // dd(//$car->attributesToArray());
        //$car = Car::orderBy("published_at", "asc")->limit(2)->get();
        //$car = Car::limit(2)->get();
        //$car = Car::where("price", ">", "90000")
        // ->where("user_id", 1)
        // ->limit(2)->get();
        // dd(//$car);
        // $car = new Car();
        // $car->maker_id = 1;
        // $car->model_id = 1;
        // $car->year = 1900;
        // $car->price = 123;
        // $car->vin = 123;
        // $car->mileage = 123;
        // $car->car_type_id = 1;
        // $car->fuel_type_id = 1;
        // $car->user_id = 1;
        // $car->city_id = 1;
        // $car->address = "Lorem Ipsum";
        // $car->phone = "123";
        // $car->description = null;
        // $car->published_at = now();
        // $cardata = [
        //     "maker_id" => 1,
        //     "model_id" => 1,
        //     "year" => 2014,
        //     "price" => 40000000,
        //     "vin" => '999',
        //     "mileage" => 8000,
        //     "car_type_id" => 1,
        //     "fuel_type_id" => 1,
        //     "user_id" => 1,
        //     "city_id" => 1,
        //     "address" => "Lorem Ipsum",
        //     "phone" => "123",
        //     "description" => null,
        //     "published_at" => now()
        // ];
        //Approach1
        // $car = Car::create($cardata);
        //Approach 2
        // $car2 = new Car();
        //fill() is a mass-assignment method in Laravel that allows you to populate a model's attributes dynamically using an associative array. It helps assign values to multiple attributes at once,
        // but only for fields that are whitelisted in the $fillable property of the model.
        // $car2->fill($cardata);
        // $car2->save();

        //fill($data) + save()	When you need to modify the object before saving
        //	$car->fill($data); $car->save();
        //	When you want to insert a new record in one line	Car::create($data);

        //Approach3
        //  $car3 = new Car($cardata);
        //  $car3->save();

        // $car = Car::find(1);
        // $car->price = 90000;
        // $car->save();

        // $car = Car::updateOrCreate(["price" => 100000, "vin" => 5], ["price" => 550000]);
        // dd($car);
        //it will now insert data bcz update will not done bcz the data present in first param is not present 
        //in db so it will create the 2nd param cardata
        //  $car = Car::updateOrCreate(["price" => 100000, "vin" => 9], $cardata);
        //  Car::where("published_at", null)->where("user_id", 1)->update(["published_at" => now()]);
        //Car::where("updated_at", 0)->where("user_id", 1)->update(["updated_at" => now()]);
        //$car = Car::find(1);
        // $car->delete();
        //it will only populate the delete_at timestamp column 

        //and it will soft deletes it from model not db
        //so when we again run the query to find with id 1 it will show 
        //Call to a member function delete() on null::it will not able to find the data

        //The destroy() method in Laravel soft deletes records by their primary key same as above.
        // Car::destroy([2, 3]);
        // Car::destroy(2, 3);

        // Car::where("published_at", null)->where("user_id", 1)->delete();
        //Car::truncate();
        //deletes all records from a table and resets the auto-increment ID.
        //Resets the auto-increment ID back to 1.
        //Does not trigger soft deletes (it permanently deletes data).
        //table structure remain same


        //$car = Car::where("price", ">", 1000000)->get();
        //$maker = Maker::where("name", "Toyota")->first();
        //dd($maker);
        // $fueltype = new FuelType();
        // $fueltype->name = "Electric";
        // $fueltype->save();
        // FuelType::create(["name" => "Biodiesel"]);

        //Car::where("id", 1)->where("user_id", 1)->update(["price" => 15000]);
        //Car::where("year", "<", 2020)->delete();


        // $car = Car::find(2);
        // dd($car->features, $car->primaryImage);

        //Update abs to 0 for car id 3 in features table
        //One to One relationship
        // $car = Car::find(3);
        // $car->features()->abs = 0;
        // $car->save();

        //Update power_windows to 1 for car id 1 in features table
        //One to One relationship
        // $car = Car::find(1);
        // $car->features->update(["power_windows" => 1]);


        //Delete the car image row with car id 2
        //One to One relationship
        // $car = Car::find(2);
        // $car->primaryImage->delete();

        //Create car features row with car id 9 and with the below features
        //One to One relationship
        // $car = Car::find(id: 9);
        // $carfeatures = new CarFeatures([

        //     "abs" => false,
        //     "air_conditioning" => false,
        //     "power_windows" => false,
        //     "power_door_locks" => false,
        //     "cruise_control" => false,
        //     "bluetooth_connectivity" => false,
        //     "remote_start" => false,
        //     "gps_navigation" => false,
        //     "heater_seats" => false,
        //     "climate_control" => false,
        //     "rear_parking_sensors" => false,
        //     "leather_seats" => false
        // ]);
        //   $car->features()->save($carfeatures);
        //  dd($car->images);

        //Create car image new row with car_id 1 and the below data
        //One to Many relationship
        //one car id with many image path
        // $car = Car::find(1);
        // $image = new CarImage(["image_path" => "test1", "position" => 10]);
        // $car->images()->save($image);

        //Create car image new row with car_id 1 and the below data
        //One to Many relationship
        //one car id with many image path
        // $car = Car::find(1);
        // $car->images()->create(["image_path" => "test1", "position" => 11]);


        //Create many car images new row with car_id 1 and the below data
        //One to Many relationship
        // $car = Car::find(1);
        // $car->images()
        //     ->saveMany(
        //         [
        //             new CarImage(["image_path" => "test1", "position" => 13]),
        //             new CarImage(["image_path" => "test1", "position" => 14])
        //         ]
        //     );
        // $car->images()
        //     ->createMany([
        //         ["image_path" => "test1", "position" => 15],
        //         ["image_path" => "test1", "position" => 16]
        //     ]);


        //Many to one relationship

        // $car = Car::find(1);
        // dd($car->carType);

        // $carType = CarType::where('name', 'Sedan')->first();
        //  dd($carType->cars);
        // $cars = Car::whereBelongsTo($carType)->get();
        // dd($cars);

        // $car = Car::find(1);
        // $carType = CarType::where('name', 'SUV')->first();
        // $car->car_type_id = $carType->id;
        //This line sets the car_type_id attribute of the $car instance to the id of the $carType instance. 
        //This establishes the relationship between the Car and its CarType.
        // $car->save();

        // $car = Car::find(1);
        // $carType = CarType::where('name', 'SUV')->first();
        //$car->carType()->associate($carType);
        //sets the car_type_id foreign key on the Car model to the ID of the retrieved CarType.
        // $car->save();

        //Many to many relationship
        // $car = Car::find(1);
        // dd($car->favouredUsers);
        // $user = User::find(1);
        // dd($user->favouredCars);

        //it will insert cars with id 1 and 2 in 2 rows with having user id 1 in 
        //favourite_cars table
        // $user = User::find(1);
        // $user->favouredCars()->attach([1, 2]);

        //it will delete cars with id 1 and 2 in 2 rows with having user id 1 in 
        //favourite_cars table
        // $user = User::find(1);
        // $user->favouredCars()->detach([3, 4]);
        //$user->favouredCars()->detach();//this will detach all record ..dont depend on id

        //it will insert cars with id 3 and 4 in 2 rows with having user id 1 in 
        //favourite_cars table
        //but before inserting it will delete the existing table data which is present
        // $user = User::find(1);
        // $user->favouredCars()->sync([3, 4]);

        //   If you have a User model related to a Car model through a pivot table (e.g., favoured_cars), and you want to synchronize the user's favored cars while attaching additional data, you can use syncWithPivotValues as follows:



        // $user = User::find(1);
        // $user->favouredCars()->syncWithPivotValues([9, 10], ['added_on' => now()]);
        //The user with ID 1 will be associated with the cars having IDs 9 and 10.
        //Each association will have an added_on field in the pivot table set to the current timestamp.
        //Any existing associations not included in the [9, 10] array will be removed due to the default behavior of syncWithPivotValues.
        // $maker = Maker::factory()->make();
        //make() simply returns the model instance.
        //factories provide a convenient way to generate new model instances for testing and seeding purposes.


        // $maker = Maker::factory()->create();
        //In Laravel, the create() method serves as a convenient way to instantiate and persist new records in the database for a given Eloquent model. 
        //it create temp fake name with auto inc id in maker table


        // $maker = Maker::factory()->count(10)->create();
        //This method specifies that 10 instances of the Maker model should be created. Without this, the factory would default to creating a single instance.
        //dd($maker);

        // User::factory()->count(5)->create([
        //     "name" => "Zua"
        // ]);
        //explain
        //User::factory(): Initializes a new factory instance for the User model.
        //->count(5): Specifies that five instances should be created.
        //->create(['name' => 'Zua']): Overrides the default name attribute defined in the factory with "Zua" and persists each instance to the database.

        // $users = User::factory()->count(5)->state([
        //     "name" => "Zua"
        // ])->make();
        // dd($users);
        //This code generates five `User` model instances with the `name` attribute set to "Zua" without saving them to the database,
        // then outputs the collection of these instances using the `dd` (dump and die) function. 
        //the state() method allows you to define specific attribute modifications for generated model instances. 
        // User::factory()->count(6)->sequence(
        //     ["name" => "Zua"],
        //     ["name" => "Joe"],
        //     ["name" => "Joseph"],
        //     ["name" => "Alen"],
        //     ["name" => "Tom"],
        //     ["name" => "Azam"]
        // )
        //     ->create();
        //Creates 6 user records Each record gets a name from the sequence in order
        //After the last value, it does not repeat (unless count is greater than sequence values, then it loops)
        // Other attributes are still generated randomly unless explicitly defined
        //This ensures that the first user will have "Zua", the second "Joe", and so on,
        //rather than all users having the same name.


        // User::factory()->count(10)
        //     ->sequence(fn(Sequence $sequence) => ['name' => 'Name ' . $sequence->index])
        //     ->create();
        //dynamically generates values based on the sequence index.
        // The $sequence->index represents the current index in the sequence.
        //It starts at 0 and increments for each new record. 
        //This dynamically assigns unique values instead of hardcoding them.
        //it creates 10 record in table with name 0 ...name 9 and other fields as mentioned
        //in userfactory ,in that format all fields will be generate with fake data

        // $user = User::withTrashed()->find(1);

        // if ($user->trashed()) {
        //     echo "User is soft deleted.";
        // } else {
        //     echo "User is active.";
        // }
        //withTrashed() allows retrieving soft-deleted records.
        //trashed() checks if the deleted_at column is not null (i.e., the record is soft deleted).
        //we dont have delete_at so can't execute this

        // User::factory()->count(11)->state(["email_verified_at" => null])->create();
        //It generates 11 fake user records from userfactory where their email is unverified i.e. null.

        //User::factory()->count(11)->unverified()->create();
        //It generates 11 fake user records from userfactory where their email is unverified i.e. null.

        //User::factory()->count(11)->create();


        //one to many factory relationship
        //Maker::factory()->count(5)->hasModels(5)->create();
        //here hasModels [ Models is the func name models() in maker models with first letter caps]
        //create 5 makers with fake name in maker table
        //create 25 models with 5 maker id (from maker table )in model table 

        // Maker::factory()->count(2)->hasModels(2, ["name" => "Test"])->create();
        //it will make 4 model with name test and with 2 maker id( 2 maker id will inserted to maker table)



        // Maker::factory()->count(1)
        //     ->has(Model::factory()->count(1), 'carModels')->create();
        //if relation or func name is not same as model name in plural i.e. models then we 
        //have to mention the full func name is second param
        // Maker::factory()->count(1)
        //     ->has(Model::factory()->count(1))->create();
        //create 3 models with fake name from modelfactory and with ,maker id unique which is 
        //created in maker table (only 1 maker is created)
        //if relation or func name is  same as model name in plural i.e. models then we 
        //have not to mention the full func name is second param



        //  Model::factory()->count(5)->forMaker(["name" => "Lexus"])->create();
        //make 1 maker with name lexus in maker table(maker func in model.php so we used forMaker)
        //also create 5 model random with maker id just created

        // $maker = Maker::factory()->state(["name" => "demo"])->create();
        // Model::factory()->count(1)->for($maker)->create();
        //make 1 maker with name demo with the $maker object in maker table(maker func in model.php so we used forMaker)
        //also create 1 model random with maker id just created

        //many to many factory relationship
        // User::factory()->has(Car::factory()->count(5), 'favouredCars')
        //     ->create();
        //create 5 cars in car table with random car id , unique user id and other data in the same format
        //mentioned in carfactory
        //also 5 favouredcars with same 5 car id but same user id newly created
        //also create 1 user in user table
        //but other id like fuel type , car type remain matched with 
        //existing data from car type and fuel type table
        // User::factory()->hasAttached(Car::factory()->count(5),["col1=>"val1"], 'favouredCars')
        //     ->create();

        //  same but attached additional column with data in favoured car table but we dont have 
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
        return view("home.index", ["cars" => $cars,  "makers" => $makers,
            "models" => $models,
            "years" => $years,
            "cartypes" => $cartypes,
            "fueltypes" => $fueltypes,
            "states" => $states,
            "cities" => $cities,]);


        // return redirect()->away("https://www.google.com/");
        //return redirect()->route("car.show", Car::first());
        // return redirect()->route("car.show", ["car" => 1]);
        // return redirect()->route("car.create");
        // return redirect("/car/create");
        // return response()->view("home.index", ["cars" => $cars], 200)->withHeaders([
        //     "Header 1" => "Value1",
        //     "Header 2" => "Value2"
        // ]);
        //  return response()->json([1, 2]);
        // return ["Hello" => "World"];
        // return "Hello";
        // return Car::get();
        // return Car::first();
        // return response("Hello", 201);
        // return response("Not found", 404);
        // return response("Not found", 404)->header("Header 1", "Value1")->header("Header 2", "Value2");
        //  dd(response("Not found", 404));
    }
}
