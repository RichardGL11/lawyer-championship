<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'captain_id' => User::factory()
        ];
    }

    public function configure(): TeamFactory|Factory
    {
        return $this->afterCreating(function (Team $team){
           $team->users()->attach($team->captain->id);
        });
    }

}
