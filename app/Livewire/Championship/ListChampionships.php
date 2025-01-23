<?php

namespace App\Livewire\Championship;

use App\Models\Championship;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListChampionships extends Component
{

    #[Computed]
    public function championships(): Collection
    {
        return Championship::all();
    }

    #[Computed]
    public function myChampionships(): ?Collection
    {
        $user = User::query()->where('id',Auth::id())->first();
        return  $user->teams()->with('championships')->with('users')->get();
    }
    #[Layout('app.layouts')]
    public function render()
    {
        return view('livewire.championship.list-championships');
    }
}
