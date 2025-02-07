<?php

namespace App\Livewire;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class AlertComponent extends Component
{
    public string $message;

    #[On('echo:goal-channel,GoalEvent')]
    public function handleMessage(Team $team)
    {
        $this->message = "Goal by team $team->name";
        $this->dispatch('showAlert');
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.alert-component');
    }
}
