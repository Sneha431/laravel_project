<?php

namespace Database\Factories;

use App\Models\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maker>
 */
class MakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Maker::class; //connect the maker factory with maker model
    public function definition(): array
    {
        //In Laravel, when defining model factories to generate fake data for testing or seeding purposes, you can utilize the fake() helper function to access the Faker library's methods. The expression 'name' => fake()->word()
        //assigns a randomly generated word to the name attribute of your model.
        return [
            "name" => fake()->word()
        ];
    }
}
