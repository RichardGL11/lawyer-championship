<?php

use App\Livewire\Teams\CreateTeams;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function (){
   $this->user = User::factory()->createOne();
   actingAs($this->user);
});
it('should be able to create a Team',function (){

    Livewire::test(CreateTeams::class)
        ->set('name', 'team one')
        ->set('captain_id', $this->user->getKey())
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseCount('teams',1);
    assertDatabaseHas('teams',[
        'name' => 'team one',
        'captain_id' => $this->user->getKey()
    ]);
});
