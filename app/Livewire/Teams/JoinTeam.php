<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Notifications\NewTeamRequestNotification;
use Livewire\Component;

class JoinTeam extends Component
{

    public function requestForJoin(Team $team)
    {
        $captain = $team->captain;
        $captain->notify(new NewTeamRequestNotification(auth()->user() ,$team));
    }
    public function render()
    {
        return view('livewire.teams.join-team');
    }
}
