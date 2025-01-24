<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTeams extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;
    #[Validate('required|integer|exists:users,id')]
    public int $captain_id;

    public function save()
    {
        $this->validate();
       $team = Team::query()->create([
            'name'       => $this->name,
            'captain_id' => $this->captain_id
        ]);
       $team->users()->attach($this->captain_id);
    }
    public function render()
    {
        return view('livewire.teams.create-teams');
    }
}
