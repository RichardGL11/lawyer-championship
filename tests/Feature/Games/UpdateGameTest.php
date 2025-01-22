<?php

use App\Livewire\Games\UpdateGame;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('Administrator should be able to update an game', function(){
    $admin = User::factory()->admin()->create();
    $team1 = Team::factory()->createOne();
    $team2 = Team::factory()->createOne();
    $game = Game::factory()->create([
        'team_1_id' => $team1->getKey(),
        'team_2_id' => $team2->getKey(),
    ]);
    $day = Carbon::tomorrow()->format('Y-m-d');
    Livewire::actingAs($admin)
        ->test(UpdateGame::class)
        ->set('team1',$team1->getKey())
        ->set('team2',$team2->getKey())
        ->set('goalTeam1', 1)
        ->set('goalTeam2', 1)
        ->set('goals', 2)
        ->set('local', 'street')
        ->set('day', $day)
        ->set('winner', $game->team2)
        ->call('update', $game)
        ->assertHasNoErrors();
    assertDatabaseCount(Game::class,1);
    assertDatabaseHas(Game::class,[
       'championship_id' => $game->championship->id,
       'team_1_id'       => $game->team1->id,
       'team_2_id'       => $game->team2->id,
       'goal_team_1'     => 1,
       'goal_team_2'     => 1,
       'goals'           => 2,
       'winner'          => $game->team2->id,
       'local'           => 'street',
       'day'             => $day,
    ]);
});

test('normal user can not update an game', function () {

    $user = User::factory()->create();
    $team1 = Team::factory()->createOne();
    $team2 = Team::factory()->createOne();
    $game = Game::factory()->create([
        'team_1_id' => $team1->getKey(),
        'team_2_id' => $team2->getKey(),
    ]);
    $day = Carbon::tomorrow()->format('Y-m-d');
    Livewire::actingAs($user)
        ->test(UpdateGame::class)
        ->set('team1',$team1->getKey())
        ->set('team2',$team2->getKey())
        ->set('goalTeam1', 1)
        ->set('goalTeam2', 1)
        ->set('goals', 2)
        ->set('local', 'street')
        ->set('day', $day)
        ->set('winner', $game->team2)
        ->call('update', $game)
        ->assertForbidden();
});

describe('validation tests', function (){

    test('team1', function($rule,$value){
        $admin = User::factory()->admin()->create();
        $team1 = Team::factory()->createOne();
        $team2 = Team::factory()->createOne();
        $game = Game::factory()->create([
            'team_1_id' => $team1->getKey(),
            'team_2_id' => $team2->getKey(),
        ]);
        $day = Carbon::tomorrow()->format('Y-m-d');
        Livewire::actingAs($admin)
            ->test(UpdateGame::class)
            ->set('team1',$value)
            ->set('team2',$team2->getKey())
            ->set('goalTeam1', 1)
            ->set('goalTeam2', 1)
            ->set('goals', 2)
            ->set('local', 'street')
            ->set('day', $day)
            ->set('winner', $game->team2)
            ->call('update', $game)
            ->assertHasErrors(['team1' => $rule]);
    })->with([
        'required' => ['required', null],
        'exists'   => ['exists', 999]
    ]);
});


