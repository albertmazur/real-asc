<?php

namespace Database\Factories;

use App\Models\Stadium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stadium>
 */
class StadiumFactory extends Factory
{
    protected $model = Stadium::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'numberBuilding' => fake()->numberBetween(10, 300),
            'places' => fake()->numberBetween(2000, 9000)
        ];
    }
}
