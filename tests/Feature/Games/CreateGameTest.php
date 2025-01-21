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
beforeEach(function (){
    $this->user = User::factory()->createOne();
    $this->user2 = User::factory()->createOne();
    $this->admin = User::factory()->admin()->createOne();
    $this->championship = Championship::factory()->for($this->admin)->create();
    $this->team1 = Team::factory()->create([
        'captain_id' => $this->user->getKey()
    ]);
    $this->team2 = Team::factory()->create([
        'captain_id' => $this->user2->getKey()
    ]);
    $this->day = Carbon::tomorrow()->format('Y-m-d');
});

it('should be able to create a game', function (){
    Livewire::actingAs($this->user)
        ->test(CreateGame::class)
        ->set('team1',$this->team1->getKey())
        ->set('team2',$this->team2->getKey())
        ->set('championship', $this->championship->getKey())
        ->set('day',$this->day )
        ->call('save')
        ->assertHasNoErrors()
        ->assertOk();

    assertDatabaseCount(Game::class,1);
    assertDatabaseHas(Game::class,[
       'championship_id' =>$this->championship->getKey(),
       'team_1_id' => $this->team1->getKey(),
       'team_2_id' => $this->team2->getKey(),
       'day'       => $this->day
    ]);

    $game = Game::query()->first();
    expect($game)
        ->championship_id->toBe($this->championship->getKey())
        ->team_1_id->toBe($this->team1->getKey())
        ->team_2_id->toBe($this->team2->getKey())
        ->day->toBe($this->day)
        ->and($game->championship->id)
        ->toBe($this->championship->getKey());

});

describe('validation tests', function (){

    test('team1::validations',function ($rule,$value){
        Livewire::actingAs($this->user)
            ->test(CreateGame::class)
            ->set('team1',$value)
            ->set('team2',$this->team2->getKey())
            ->set('championship', $this->championship->getKey())
            ->set('day',$this->day )
            ->call('save')
            ->assertHasErrors(['team1' => $rule]);

    })->with([
        'required' => ['required', null],
        'exists'   => ['exists', 9999]
    ]);

    test('team2::validations',function ($rule,$value){
       $livewire = Livewire::actingAs($this->user)
            ->test(CreateGame::class)
            ->set('team1',$this->team1->getKey())
            ->set('team2',$value)
           ->set('championship', $this->championship->getKey())
            ->set('day', $this->day)
            ->call('save')
            ->assertHasErrors(['team2' => $rule]);
    })->with([
        'required'  => ['required', null],
        'exists'    => ['exists', 9999],
    ]);

    test('team2::different',function (){
       $livewire = Livewire::actingAs($this->user)
            ->test(CreateGame::class)
            ->set('team1',$this->team1->getKey())
            ->set('team2',$this->team1->getKey())
           ->set('championship', $this->championship->getKey())
            ->set('day', $this->day)
            ->call('save')
            ->assertHasErrors(['team2' => "The team2 field and team1 must be different."]);
    });

});
