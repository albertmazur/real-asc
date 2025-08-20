<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()->count(50)->state(new Sequence(fn ($sequence) =>[
            'event_id' => fake()->numberBetween(1, 20),
            'user_id' =>fake()->numberBetween(1, 10)
        ]))->create();
    }
}
