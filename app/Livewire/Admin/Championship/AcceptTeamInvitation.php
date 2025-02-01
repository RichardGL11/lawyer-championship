<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use App\Models\Team;
use Livewire\Component;

class AcceptTeamInvitation extends Component
{
    public function mount(Team $team, Championship $championship)
    {
        $championship->teams()->attach($team->id);
        return redirect()->to('/dashboard');
    }

}
