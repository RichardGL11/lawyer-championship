<?php

namespace Database\Factories;

use App\Models\Championship;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'championship_id' => Championship::factory(),
            'team_1_id'       => Team::factory(),
            'team_2_id'       => Team::factory()->newInstance(),
            'goal_team_1'     => 0,
            'goal_team_2'     => 0,
            'goals'           => 0,
            'winner'          => null,
            'day'             => Carbon::tomorrow()->format('Y-m-d')
        ];
    }
}
