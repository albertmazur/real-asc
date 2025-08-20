<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'qr_token' => fake()->unique()->uuid(),
            'dateBuy' => fake()->date(),
            'timeBuy' => fake()->time(),
            'stripe_payment_id' => fake()->uuid(),
            'state' => fake()->randomElement(array_column(TicketStatus::cases(), 'value')),
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'used_at' => null,
        ];
    }
}
