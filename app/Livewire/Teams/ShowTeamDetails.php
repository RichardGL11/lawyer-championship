<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowTeamDetails extends Component
{
    public Team $team;

    public function mount(Team $team):void
    {
        $this->team = $team;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.teams.show-team-details');
    }
}
