<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class AccepInvitationRequest extends Component
{
    public function mount(User $user, Team $team)
    {
        $team->users()->attach($user->id);
        return response()->redirectTo('/dashboard');
    }

}
