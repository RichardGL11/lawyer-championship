<?php

namespace App\Livewire\Games;

use App\Models\Championship;
use App\Models\Game;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ListGames extends Component
{
    public Championship $championship;
    #[Computed]
    public function games()
    {
        return Game::query()->where('championship_id', $this->championship->id)->get();
    }


    public function mount(Championship $championship)
    {
        $this->championship = $championship;
    }

    #[On('echo:goal-channel,GoalEvent')]
    #[On('game::created')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.games.list-games');
    }
}
