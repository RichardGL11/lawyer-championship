<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class AccepInvitationRequest extends Component
{
    public function acceptInvitationRequest(User $user, Team $team)
    {
        $team->users()->attach($user->id);
    }
    public function render()
    {
        return view('livewire.teams.accep-invitation-request');
    }
}
