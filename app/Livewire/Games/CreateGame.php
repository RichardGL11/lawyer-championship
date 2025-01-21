<?php

namespace App\Livewire\Games;

use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateGame extends Component
{
    #[Validate('bail|required|exists:teams,id')]
    public string|Team $team1;
    #[Validate('required|exists:teams,id|different:team1')]
    public string|Team $team2;
    #[Validate('required|string|date|after:today')]
    public string $day;

    public function save()
    {
        $this->validate();

        Game::query()->create([
           'team_1_id' => $this->team1,
           'team_2_id' => $this->team2,
           'day'       => $this->day
        ]);

    }
    public function render()
    {
        return view('livewire.games.create-game');
    }
}
