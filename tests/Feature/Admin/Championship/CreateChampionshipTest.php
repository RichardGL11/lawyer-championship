<?php

use App\Models\Championship;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function () {
    $this->user = User::factory()->admin()->createOne();
    actingAs($this->user);
});

it('should be able to create a Championship Tournament', function () {

    Livewire::test(App\Livewire\Admin\Championship\Create::class)
        ->set('name', 'Brasileirao')
        ->set('championship_rules', 'apenas para maiores de 18 anos')
        ->set('start', '20-01-2025')
        ->set('end', '31-12-2025')
        ->call('save')
        ->assertSessionHasNoErrors()
        ->assertOk();

    assertDatabaseCount(Championship::class, 1);
    assertDatabaseHas(Championship::class, [
        'name' => 'Brasileirao',
        'rules' => 'apenas para maiores de 18 anos',
        'start' => '2025-01-20',
        'end'   => '2025/12/31',

    ]);

});

test('An Lawyer cannot create an championship', function () {
    $Lawyer = User::factory()->create();
    Livewire::actingAs($Lawyer)
    ->test(App\Livewire\Admin\Championship\Create::class)
        ->set('name', 'Brasileirao')
        ->set('championship_rules', 'apenas para maiores de 18 anos')
        ->set('start', '20-01-2025')
        ->set('end', '31-12-2025')
        ->call('save')
        ->assertForbidden();

    assertDatabaseCount(Championship::class, 0);
    assertDatabaseMissing(Championship::class, [
        'name' => 'Brasileirao',
        'rules' => 'apenas para maiores de 18 anos',
        'start' => '2025-01-20',
        'end'   => '2025/12/31',

    ]);
});
