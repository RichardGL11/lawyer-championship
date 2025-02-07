<?php

use App\Events\GoalEvent;
use App\Livewire\Games\UpdateGame;
use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('Administrator should be able to update an game', function(){
    Event::fake();
    $admin = User::factory()->admin()->create();
    $team1 = Team::factory()->createOne();
    $team2 = Team::factory()->createOne();
    $game = Game::factory()->create([
        'team_1_id' => $team1->getKey(),
        'team_2_id' => $team2->getKey(),
    ]);
    $day = Carbon::tomorrow()->format('Y-m-d');

    Livewire::actingAs($admin)
        ->test(UpdateGame::class,['game' => $game])
        ->set('goalTeam1', 1)
        ->set('goalTeam2', 1)
        ->set('local', 'street')
        ->set('day', $day)
        ->set('winner', $game->team2->id)
        ->call('update')
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
        ->test(UpdateGame::class,['game' => $game])
        ->assertForbidden();
});

test('when updating a goal attribute the goal event should be dispatched', function(){
    Event::fake(GoalEvent::class);
    $admin = User::factory()->admin()->create();
    $team1 = Team::factory()->createOne();
    $team2 = Team::factory()->createOne();
    $game = Game::factory()->create([
        'team_1_id' => $team1->getKey(),
        'team_2_id' => $team2->getKey(),
    ]);
    $day = Carbon::tomorrow()->format('Y-m-d');

    Livewire::actingAs($admin)
        ->test(UpdateGame::class,['game' => $game])
        ->set('goalTeam1', 1)
        ->set('goalTeam2', 1)
        ->set('local', 'street')
        ->set('day', $day)
        ->set('winner', $game->team2->id)
        ->call('update')
        ->assertHasNoErrors();

    Event::assertDispatched(GoalEvent::class);

});

describe('validation tests', function (){

    test('local', function($rule,$value){
        $admin = User::factory()->admin()->create();
        $team1 = Team::factory()->createOne();
        $team2 = Team::factory()->createOne();
        $game = Game::factory()->create([
            'team_1_id' => $team1->getKey(),
            'team_2_id' => $team2->getKey(),
        ]);
        $day = Carbon::tomorrow()->format('Y-m-d');
        Livewire::actingAs($admin)
            ->test(UpdateGame::class, ['game' => $game])
            ->set('goalTeam1', 1)
            ->set('goalTeam2', 1)
            ->set('local', $value)
            ->set('day', $day)
            ->set('winner', $game->team2)
            ->call('update', $game)
            ->assertHasErrors(['local' => $rule]);
    })->with([
        'required'  => ['required', null],
        'max'       => ['max:255', str_repeat('*',256)],
        'min'       => ['min:3','aa']
    ]);

    test('day', function($rule,$value){
        $admin = User::factory()->admin()->create();
        $team1 = Team::factory()->createOne();
        $team2 = Team::factory()->createOne();
        $game = Game::factory()->create([
            'team_1_id' => $team1->getKey(),
            'team_2_id' => $team2->getKey(),
        ]);
        $day = Carbon::tomorrow()->format('Y-m-d');
        Livewire::actingAs($admin)
            ->test(UpdateGame::class, ['game' => $game])
            ->set('goalTeam1', 1)
            ->set('goalTeam2', 1)
            ->set('local', 'street')
            ->set('day', $value)
            ->set('winner', $game->team2)
            ->call('update', $game)
            ->assertHasErrors(['day' => $rule]);
    })->with([
        'required'  => ['required', null],
        'date'       => ['date', 'aaaaaaa'],
        'after:today'       => ['after',today()]
    ]);
});


