<?php

use App\Livewire\Teams\JoinTeam;
use App\Models\Team;
use App\Models\User;
use App\Notifications\NewTeamRequestNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

test('user can request to join at a team',function (){
    Notification::fake();

    $user = User::factory()->create();
    $captain = User::factory()->create();
    $team = Team::factory()->createOne([
        'captain_id' => $captain->getKey()
    ]);

    Livewire::actingAs($user)
        ->test(JoinTeam::class)
        ->call('requestForJoin', $team)
        ->assertHasNoErrors();

    Notification::assertCount(1);
    Notification::assertSentTo([$captain], NewTeamRequestNotification::class);

});
