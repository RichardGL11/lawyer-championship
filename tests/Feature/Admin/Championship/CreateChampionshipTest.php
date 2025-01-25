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
        'end' => '2025/12/31',

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
        'end' => '2025/12/31',

    ]);
});

describe('validation tests', function () {

    test('name::validations', function ($rule, $value) {

        Livewire::test(App\Livewire\Admin\Championship\Create::class)
            ->set('name', $value)
            ->set('championship_rules', 'apenas para maiores de 18 anos')
            ->set('start', '20-01-2025')
            ->set('end', '31-12-2025')
            ->call('save')
            ->assertHasErrors(['name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min' => ['min:3', 'aa'],
        'max' => ['max:255', str_repeat('a', 256)],
    ]);

    test('championship_rules::validations', function ($rule, $value) {

        Livewire::test(App\Livewire\Admin\Championship\Create::class)
            ->set('name', 'qualquer nome')
            ->set('championship_rules', $value)
            ->set('start', '20-01-2025')
            ->set('end', '31-12-2025')
            ->call('save')
            ->assertHasErrors(['championship_rules' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min' => ['min:3', 'aa'],
        'max' => ['max:255', str_repeat('a', 256)],
    ]);

    test('start::validations', function ($rule, $value) {

        Livewire::test(App\Livewire\Admin\Championship\Create::class)
            ->set('name', 'qualquer nome')
            ->set('championship_rules', 'qualquer regra')
            ->set('start', $value)
            ->set('end', '31-12-2025')
            ->call('save')
            ->assertHasErrors(['start' => $rule]);
    })->with([
        'required' => ['required', ''],
        'date' => ['date', 'aaaaa'],
    ]);

    test('end::validations', function ($rule, $value) {

        Livewire::test(App\Livewire\Admin\Championship\Create::class)
            ->set('name', 'qualquer nome')
            ->set('championship_rules', 'qualquer regra')
            ->set('start', '31-12-2025')
            ->set('end', $value)
            ->call('save')
            ->assertHasErrors(['end' => $rule]);
    })->with([
        'required' => ['required', ''],
        'date' => ['date', 'aaaaa'],
    ]);



});
