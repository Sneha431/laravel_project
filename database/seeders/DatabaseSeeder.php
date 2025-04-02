<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\State;
use App\Models\City;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use App\Models\Car;
use App\Models\CarImage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        CarType::factory()->sequence(

            ["name" => "Sedan"],
            ["name" => "SUV"],
            ["name" => "Truck"],
            ["name" => "Van"],
            ["name" => "Coupe"],
            ["name" => "Crossover"],
            ["name" => "Hatchback"],
            ["name" => "Convertible"],
            ["name" => "Station Wagon"]


        )->count(9)->create();


        FuelType::factory()->sequence(

            ["name" => "Gas"],
            ["name" => "Diesel"],
            ["name" => "Electric"],
            ["name" => "Hybrid"]

        )->count(4)->create();


        $states = [
            "California" => ["Los Angeles", "San Francisco", "San Diego", "Sacramento", "San Jose"],
            "Texas" => ["Houston", "Dallas", "Austin", "San Antonio", "Fort Worth"],
            "Florida" => ["Miami", "Orlando", "Tampa", "Jacksonville", "Tallahassee"],
            "New York" => ["New York City", "Buffalo", "Rochester", "Albany", "Syracuse"],
            "Illinois" => ["Chicago", "Springfield", "Naperville", "Peoria", "Rockford"],
            "Ohio" => ["Columbus", "Cleveland", "Cincinnati", "Toledo", "Akron"],
            "Georgia" => ["Atlanta", "Savannah", "Augusta", "Macon", "Athens"],
            "Pennsylvania" => ["Philadelphia", "Pittsburgh", "Allentown", "Erie", "Scranton"],
            "Arizona" => ["Phoenix", "Tucson", "Mesa", "Chandler", "Glendale"],
            "Michigan" => ["Detroit", "Grand Rapids", "Ann Arbor", "Lansing", "Flint"]
        ];

        foreach ($states as $state => $cities) {
            State::factory()->state(['name' => $state])->has(City::factory()->count(count($cities)))
                ->sequence(...array_map(fn($city) => ['name' => $city], $cities))->create();
        }

        $makers = [
            "Toyota" => ["Camry", "Corolla", "RAV4", "Highlander", "Tacoma"],
            "Honda" => ["Civic", "Accord", "CR-V", "Pilot", "Odyssey"],
            "Ford" => ["F-150", "Mustang", "Escape", "Explorer", "Bronco"],
            "Chevrolet" => ["Silverado", "Malibu", "Equinox", "Tahoe", "Camaro"],
            "BMW" => ["3 Series", "5 Series", "X5", "X3", "M4"],
            "Mercedes-Benz" => ["C-Class", "E-Class", "GLC", "GLE", "S-Class"]
        ];


        foreach ($makers as $maker => $models) {
            Maker::factory()->state(['name' => $maker])->has(Model::factory()->count(count($models)))
                ->sequence(...array_map(fn($model) => ['name' => $model], $models))->create();
        }

        User::factory()->count(3)->create();

        User::factory()->count(2)
            ->has(Car::factory()->count(50)
                ->has(
                    CarImage::factory()->count(5)
                        // ->sequence(fn(Sequence $sequence) =>
                        // ["position" => $sequence->index  + 1]),
                        ->sequence(fn(Sequence $sequence) =>
                        ["position" => $sequence->index % 5 + 1]),
                    // ->sequence(
                    //     ["position" => 1],
                    //     ["position" => 2],
                    //     ["position" => 3],
                    //     ["position" => 4],
                    //     ["position" => 5],
                    // ),

                    'images'
                )->hasFeatures(), 'favouredCars')->create();
    }
}