<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use App\Models\Team;
use App\Notifications\ChampionshipRequestNotification;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class JoinChampionship extends Component
{
    public Collection $teams;
    public Championship $championship;
    public function mount(Championship $championship):void
    {
        $this->championship = $championship;
        $this->teams = Team::query()->where('captain_id','=', 11)->get();
    }


    public function sendRequest(Team $team,Championship $championship)
    {
        if ($this->championship->teams()->where('team_id',$team->id)->exists()){
            return;
        }

        $championship->user->notify(new ChampionshipRequestNotification(team: $team, championship: $championship));

  }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.championship.join-championship');
    }
}
