<?php

namespace App\Livewire\Games;

use App\Enums\UserTypeEnum;
use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function Pest\Laravel\instance;
use function PHPUnit\Framework\isInstanceOf;

class UpdateGame extends Component
{
    #[Validate('required')]
    public Game $game;
    #[Validate('required')]
    public Team $team1;
    #[Validate('required|different:team1')]
    public Team $team2;
    #[Validate('sometimes','exists:teams,id','in:team1,team2')]
    public string|Team $winner;
    #[Validate('nullable|integer')]
    public int $goalTeam1;
    #[Validate('nullable|integer')]
    public int $goalTeam2;
    #[Validate('required|string|min:3|max:255')]
    public string $local;
    #[Validate('required|string|date|after:today')]
    public string $day;

    public function mount(Game $game)
    {
        $this->game = $game;
        $this->team1 = $game->team1;
        $this->team2 = $game->team2;
        $this->goalTeam1 = $game->goal_team_1;
        $this->goalTeam2 = $game->goal_team_2;
        $this->local = $game->local;
        $this->day = $game->day;
    }
    public function update():void
    {

        $this->validate();
        $this->authorize('update',$this->game);
        $this->game->team_1_id   = $this->team1->id;
        $this->game->team_2_id   = $this->team2 instanceof Team ? $this->team2->id : $this->team2;
        $this->game->goal_team_1 = $this->goalTeam1;
        $this->game->goal_team_2 = $this->goalTeam2;
        $this->game->local       = $this->local;
        $this->game->winner      = $this->winner instanceof Team? $this->winner->int: (int) $this->winner;
        $this->game->day         = $this->day;
        $this->game->goals       = $this->goalTeam1 + $this->goalTeam2;
        $this->game->update();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        abort_if(auth()->user()->user_type != UserTypeEnum::Admin,403);
        return view('livewire.games.update-game');
    }
}
