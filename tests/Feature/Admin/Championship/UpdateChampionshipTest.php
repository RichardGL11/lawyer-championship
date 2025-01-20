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

    $championship = Championship::factory()->create([
        'name'  => 'fake_name',
        'rules' => 'rules for championship',
        'start' => '2026-08-21',
        'end'   => '2027-08-21',
    ]);
    Livewire::test(App\Livewire\Admin\Championship\Update::class)
        ->set('name', 'Brasileirao')
        ->set('championship_rules', 'apenas para maiores de 18 anos')
        ->set('start', '20-01-2025')
        ->set('end', '31-12-2025')
        ->call('update', $championship)
        ->assertSessionHasNoErrors()
        ->assertOk();

    assertDatabaseCount(Championship::class, 1);
    assertDatabaseHas(Championship::class, [
        "name"  => "Brasileirao",
        "rules" => "apenas para maiores de 18 anos",
        "start" => "2025-01-20",
        "end"   => "2025-12-31"
    ]);

    assertDatabaseMissing(Championship::class,[
        'name'  => 'fake_name',
        'rules' => 'rules for championship',
        'start' => '2026-08-21',
        'end'   => '2027-08-21',
    ]);

    expect($championship)
        ->name->toBe('Brasileirao')
        ->rules->toBe("apenas para maiores de 18 anos")
        ->start->toBe("2025-01-20")
        ->end->toBe("2025-12-31");

});
