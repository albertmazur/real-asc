<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            "role" => "admin",
            "password"=> bcrypt("Admin123"),
            "remember_token" => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
