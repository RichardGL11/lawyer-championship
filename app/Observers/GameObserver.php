<?php

namespace App\Observers;

use App\Events\GoalEvent;
use App\Models\Game;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    public function created(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "updated" event.
     */
    public function updated(Game $game): void
    {
        if ($game->isDirty('goal_team_1') ){
            GoalEvent::dispatch($game->team1);
        }
        elseif ($game->isDirty('goal_team_2')){
            GoalEvent::dispatch($game->team2);
        }
    }
}
