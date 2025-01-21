<?php

use App\Livewire\Admin\Championship\JoinChampionship;
use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use App\Notifications\ChampionshipRequestNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

test('A captain should request to his team join a championship', function (){
    Notification::fake();
    $captain = User::factory()->create();
    $team = Team::factory()->create(['captain_id' => $captain->getKey()]);
    $admin = User::factory()->admin()->create();
    $championship = Championship::factory()->for($admin)->createOne();


    Livewire::actingAs($captain)
        ->test(JoinChampionship::class)
        ->call('sendRequest', $team, $championship)
        ->assertHasNoErrors();

    Notification::assertCount(1);
    Notification::assertSentTo([$admin],  ChampionshipRequestNotification::class);
    Notification::assertSentTo($admin, function (ChampionshipRequestNotification $notification) use ($captain, $admin, $team,$championship){
        return $notification->team->captain->id === $captain->id and
           $notification->championship->user->id === $admin->id and
            $notification->toMail($captain)->subject  == "The user {$team->captain->name} captain of the team:  {$team->name}, request for participate to the championship {$championship}";
    });


});
