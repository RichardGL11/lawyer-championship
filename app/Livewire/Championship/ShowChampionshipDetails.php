<?php

namespace App\Livewire\Championship;

use App\Models\Championship;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowChampionshipDetails extends Component
{
    public Championship $championship;

    public function mount(Championship $championship):void
    {
        $this->championship = $championship;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.championship.show-championship-details');
    }
}
