<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Models\User;
use App\Notifications\NewTeamRequestNotification;
use Livewire\Attributes\Layout;
use Livewire\Component;

class JoinTeam extends Component
{
    public User $captain;

    public function mount(Team $team)
    {
        $this->captain = $team->captain;
        $this->captain->notify(new NewTeamRequestNotification(auth()->user() ,$team));
        return response()->redirectTo('/dashboard');

    }
}
