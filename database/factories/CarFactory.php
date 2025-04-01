<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Maker;
use App\Models\Model;

use App\Models\CarType;
use App\Models\FuelType;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'maker_id' => Maker::inRandomOrder()->first()->id,
            //Selects a random maker_id from the makers table.
            // Ensures that each generated record is linked to an existing Maker.
            'model_id' => function (array $attributes) {
                //The function dynamically generates a model_id based on the selected maker_id
                //Finds models that belong to the same maker_id. Picks a random model from those filtered results. 
                //Retrieves its id and assigns it to model_id.
                return Model::where('maker_id', $attributes['maker_id'])->inRandomOrder()->first()->id;
            },
            "year" => fake()->year(),
            "price" => ((int)fake()->randomFloat(2, 5, 100)) * 1000,
            "vin" => strtoupper(Str::random(17)),
            "mileage" => ((int)fake()->randomFloat(2, 5, 500)) * 1000,
            "car_type_id"  => CarType::inRandomOrder()->first()->id ?? CarType::factory()->create()->id,
            "fuel_type_id" => FuelType::inRandomOrder()->first()->id ?? FuelType::factory()->create()->id,
            "user_id"      => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "city_id" => optional(City::inRandomOrder()->first())->id ?? City::factory()->for(State::factory()->create())->create()->id,



            "address" => fake()->address(),
            "phone" => function (array $attributes) {
                return User::find($attributes["user_id"])->phone;
            },
            "description" => fake()->text(2000),
            "published_at" => fake()->optional(0.9)->dateTimeBetween("-1 month", "+1 day")
            //1. fake() Calls Laravel's Faker instance to generate fake data.
            // 2. optional() Randomly includes or excludes the published_at field.
            //Sometimes it will return a dateTimeBetween(), and sometimes it will return null.
            // 3. dateTimeBetween("-1 month", "+1 day") 
            //Generates a random date and time between 1 month ago and 1 day in the future.
            //optional(0.9) 0.9 means 90% probability that dateTimeBetween() will return a date.
        ];
    }
}