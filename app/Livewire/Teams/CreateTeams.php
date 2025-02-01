<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTeams extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;

    public function save()
    {
        $this->validate();
       $team = Team::query()->create([
            'name'       => $this->name,
            'captain_id' => auth()->user()->id
        ]);
       $team->users()->attach(auth()->user()->id);
       return redirect()->to('/dashboard');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.teams.create-teams');
    }
}
