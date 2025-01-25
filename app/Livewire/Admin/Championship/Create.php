<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public ?string $name;

    #[Validate('required|string|min:3|max:255')]
    public string $championship_rules;

    #[Validate('required|string|date')]
    public string $start;

    #[Validate('required|string|date')]
    public string $end;

    public function save()
    {

        $this->validate();
        $this->authorize('create', Championship::class);

        Championship::query()->create([
            'name' => $this->name,
            'rules' => $this->championship_rules,
            'start' => $this->start,
            'end' => $this->end,
            'user_id' => auth()->user()->id
        ]);
        return response()->redirectTo('/dashboard');

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.championship.create');
    }
}
