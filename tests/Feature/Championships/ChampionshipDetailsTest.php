<?php

use App\Livewire\Championship\ShowChampionshipDetails;
use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
it('loads correctly', function (){
   Livewire::test(ShowChampionshipDetails::class)
     ->assertStatus(200);
});

test('user can see details of a championship', function (){
    $players = User::factory(15)->create();
    $championship = Championship::factory()->create();
    $team = Team::factory()->create();
    $players->each(function ($player) use ($team){
       $team->users()->attach($player->getKey());
    });
    $championship->teams()->attach($team);

    actingAs(User::factory()->create());
    $response = get(route('championships.show',$championship->getKey()));

    $response->assertSee($championship->name);
    $response->assertSee($championship->rules);
    $response->assertSee($team->captain->name);
    $response->assertSee($team->users()->count());
    $response->assertSeeText("Rules:");
    $response->assertSeeText("The team has {$team->users->count()} players, ask for the captain for joining {$team->captain->name}");
});
