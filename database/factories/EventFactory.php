<?php

namespace Database\Factories;

use App\Models\Stadium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->text(),
            'date' => fake()->dateTimeThisDecade('+4 years'),
            'time' => fake()->time(),
            'price' =>fake()->randomFloat(2, 20, 200),
            'stadium_id' => Stadium::factory()
        ];
    }
}
