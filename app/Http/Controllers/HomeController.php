<?php

namespace App\Http\Controllers;

use App\Models\Car;
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
        $car = new Car();
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
        $cardata = [
            "maker_id" => 1,
            "model_id" => 1,
            "year" => 2014,
            "price" => 40000000,
            "vin" => '999',
            "mileage" => 8000,
            "car_type_id" => 1,
            "fuel_type_id" => 1,
            "user_id" => 1,
            "city_id" => 1,
            "address" => "Lorem Ipsum",
            "phone" => "123",
            "description" => null,
            "published_at" => now()
        ];
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
        Car::where("year", "<", 2020)->delete();
        return view("home.index");
    }
}
