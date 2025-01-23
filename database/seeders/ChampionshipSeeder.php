<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChampionshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Championship::factory(3)->create([
            'user_id' => User::factory()->admin()
        ]);
        Championship::factory()
            ->has(Team::factory()->count(3))
            ->create();
    }
}
