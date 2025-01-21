<?php

use App\Livewire\Games\CreateGame;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should be able to create a game', function (){
    $user = User::factory()->createOne();
    $user2 = User::factory()->createOne();
    $admin = User::factory()->admin()->createOne();
    $championship = Championship::factory()->for($admin)->create();
    $team1 = Team::factory()->create([
        'captain_id' => $user->getKey()
    ]);
    $team2 = Team::factory()->create([
        'captain_id' => $user2->getKey()
    ]);
    $day = Carbon::tomorrow()->format('Y-m-d');


    Livewire::actingAs($user)
        ->test(CreateGame::class)
        ->set('team1',$team1->getKey())
        ->set('team2',$team2->getKey())
        ->set('day',$day )
        ->call('save')
        ->assertHasNoErrors()
        ->assertOk();

    assertDatabaseCount(Game::class,1);
    assertDatabaseHas(Game::class,[
       'team_1_id' => $team1->getKey(),
       'team_2_id' => $team2->getKey(),
       'day'       => $day
    ]);

    $game = Game::query()->first();
    expect($game)
        ->team_1_id->toBe($team1->getKey())
        ->team_2_id->toBe($team2->getKey())
        ->day->toBe($day);
});
