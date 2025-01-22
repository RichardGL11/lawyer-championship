<?php

namespace App\Livewire\Games;

use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function Pest\Laravel\instance;
use function PHPUnit\Framework\isInstanceOf;

class UpdateGame extends Component
{
    #[Validate('required')]
    public Team $team1;
    #[Validate('required|different:team1')]
    public Team $team2;
    #[Validate('sometimes','exists:teams,id','in:team1,team2')]
    public Team $winner;
    #[Validate('nullable|integer')]
    public int $goalTeam1;
    #[Validate('nullable|integer')]
    public int $goalTeam2;
    #[Validate('required|string|min:3|max:255')]
    public string $local;
    #[Validate('required|string|date|after:today')]
    public string $day;

    public function update(Game $game):void
    {
        $this->validate();
        $this->authorize('update',$game);
        $game->team_1_id   = $this->team1 instanceof Team ? $this->team1->id : $this->team1;
        $game->team_2_id   = $this->team2 instanceof Team ? $this->team2->id : $this->team2;
        $game->goal_team_1 = $this->goalTeam1;
        $game->goal_team_2 = $this->goalTeam2;
        $game->local       = $this->local;
        $game->winner      = $this->winner->id;
        $game->day         = $this->day;
        $game->goals       = $this->goalTeam1 + $this->goalTeam2;
        $game->update();

    }
    public function render()
    {
        return view('livewire.games.update-game');
    }
}
