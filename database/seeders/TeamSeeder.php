<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::factory([
            'captain_id' => User::factory()->newModel()
        ]);

        Team::factory(3)
            ->has(User::factory()->count(5))
            ->create();
    }
}
