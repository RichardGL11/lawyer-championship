<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{

    #[Validate('bail|required|string|min:3|max:255')]
    public ?string $name;

    #[Validate('required|string|min:3|max:255')]
    public string $championship_rules;

    #[Validate('required|string|date_format:d-m-Y')]
    public string $start;

    #[Validate('required|string|date_format:d-m-Y')]
    public string $end;

    public function save():void
    {

        $this->validate();
        $this->authorize('create', Championship::class);

         Championship::query()->create([
            'name'  => $this->name,
            'rules' => $this->championship_rules,
            'start' => $this->start,
            'end'   => $this->end,
        ]);

    }

    public function render()
    {
        return view('livewire.admin.championship.create');
    }
}
