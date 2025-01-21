<?php

namespace App\Livewire\Admin\Championship;

use App\Enums\UserTypeEnum;
use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
use App\Notifications\ChampionshipRequestNotification;
use Livewire\Component;

class JoinChampionship extends Component
{
    public function sendRequest(Team $team, Championship $championship)
    {
        $championship->user->notify(new ChampionshipRequestNotification(team: $team, championship: $championship));
    }
    public function render()
    {
        return view('livewire.admin.join');
    }
}
