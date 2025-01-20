<?php

use App\Livewire\Admin\Championship\Delete;
use App\Models\Championship;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

it('should be able to delete a Championship',function (){
    $user = User::factory()->admin()->create();
    $championship = Championship::factory()->create();

    Livewire::actingAs($user)
        ->test(Delete::class)
        ->call('delete',$championship)
        ->assertHasNoErrors();

    assertDatabaseCount(Championship::class,0);
    assertModelMissing($championship);
});
test('Lawyer cant delete a championship',function (){
    $user = User::factory()->create();
    $championship = Championship::factory()->create();

    Livewire::actingAs($user)
        ->test(Delete::class)
        ->call('delete',$championship)
        ->assertForbidden();

    assertDatabaseCount(Championship::class,1);
    assertModelExists($championship);
});
