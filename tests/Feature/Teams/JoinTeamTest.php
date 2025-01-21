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

    Notification::assertSentTo($captain, function (NewTeamRequestNotification $notification, array $channels) use ($captain, $user, $team){
        return $notification->team->captain->id === $captain->id and
        $notification->toMail($captain)->subject  == "The user {$user->name} is asking you if he can joins at the team: {$team->name}";
    });


});
