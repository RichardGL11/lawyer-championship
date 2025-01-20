<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    #[Validate('sometimes|string|min:3|max:255')]
    public ?string $name;
    #[Validate('sometimes|string|min:3|max:255')]
    public string $championship_rules;

    #[Validate('sometimes|string|date_format:d-m-Y')]
    public string $start;

    #[Validate('sometimes|string|date_format:d-m-Y')]
    public string $end;

    public function update(Championship $championship):void
    {
        $this->validate();
        $this->authorize('update', $championship);

        $championship->name = $this->name;
        $championship->start = $this->start;
        $championship->end = $this->end;
        $championship->rules = $this->championship_rules;
        $championship->save();
    }

    public function render()
    {
        return view('livewire.admin.championship.update');
    }
}
