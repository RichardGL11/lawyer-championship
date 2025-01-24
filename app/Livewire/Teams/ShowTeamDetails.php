<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowTeamDetails extends Component
{
    public Team $team;
    public bool $belongs;
    public function userBelongsToTheTeam()
    {
        if($this->team->users()->where('user_id', Auth::id())->exists()){
            return $this->belongs = true;
        };

        return $this->belongs = false;
    }

    public function mount(Team $team):void
    {
        $this->team = $team;
        $this->userBelongsToTheTeam();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.teams.show-team-details');
    }
}
