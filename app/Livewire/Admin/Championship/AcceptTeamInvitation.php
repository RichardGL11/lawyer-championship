<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Team;
use Livewire\Component;

class AcceptTeamInvitation extends Component
{
    public function accept(Team $team)
    {

    }
    public function render()
    {
        return view('livewire.admin.championship.accept-team-invitation');
    }
}
