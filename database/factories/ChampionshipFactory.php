<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Championship>
 */
class ChampionshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'rules' => fake()->sentence(),
            'start' => now(),
            'end'   => '31-12-2025',
            'user_id' => User::factory()->admin()
        ];
    }
}
