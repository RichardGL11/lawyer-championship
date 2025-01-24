<?php

use App\Livewire\Teams\ShowTeamDetails;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('renders successfully', function () {
    Livewire::test(ShowTeamDetails::class)
        ->assertStatus(200);
});

test('loads the information about the team', function () {
    $captain = User::factory()->createOne();
    $users = User::factory(5)->create();
    $team = Team::factory()->create([
        'captain_id' => $captain->getKey()
    ]);
    $users->each(function ($user) use($team){
        $team->users()->attach($user);
    });

    actingAs(User::factory()->create());

    $response = get(route('teams.show',$team));
    $response->assertSeeText($team->name);
    $response->assertSeeText($team->captain->name);

    $users->each(function ($user) use ($response){
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertSee($user->goals()->count());
        $response->assertSee($user->assistance()->count());
    });

});
