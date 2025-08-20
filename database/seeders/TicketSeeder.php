<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory()->count(25)->create([
            'event_id' => fake()->numberBetween(1, 20),
            'user_id' =>fake()->numberBetween(1, 10)
        ]);
    }
}
