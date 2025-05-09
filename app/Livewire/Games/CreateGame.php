<?php

namespace App\Livewire\Games;

use App\Models\Championship;
use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateGame extends Component
{
    #[Validate('bail|required|exists:teams,id')]
    public string|Team $team1;
    #[Validate('required|exists:teams,id|different:team1')]
    public string|Team $team2;

    #[Validate('required')]
    public Championship $championship;
    #[Validate('required|string|date|after:today')]
    public string $day;

    #[Validate('required|string|min:3|max:255')]
    public string $local;

    public function save()
    {
        $this->validate();

        Game::query()->create([
            'championship_id' => $this->championship->getKey(),
           'team_1_id'        => $this->team1,
           'team_2_id'        => $this->team2,
           'day'              => $this->day,
           'local'            => $this->local
        ]);
        $this->pull('team1','team2','local','day');

        $this->dispatch('game::created')->to(ListGames::class);

    }
    #[Layout('app.layouts')]
    public function render()
    {
        return view('livewire.games.create-game');
    }
}
