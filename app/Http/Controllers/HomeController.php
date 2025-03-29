<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
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
        $user = User::find(1);
        $user->favouredCars()->attach([1, 2]);

        //it will delete cars with id 1 and 2 in 2 rows with having user id 1 in 
        //favourite_cars table
        // $user = User::find(1);
        // $user->favouredCars()->detach([3, 4]);

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
        return view("home.index");
    }
}
