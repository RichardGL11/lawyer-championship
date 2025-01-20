<?php

namespace App\Livewire\Admin\Championship;

use App\Models\Championship;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Delete extends Component
{


    public function delete(Championship $championship):void
    {
        $this->authorize('delete', $championship);
        $championship->delete();
    }

    public function render()
    {
        return view('livewire.admin.championship.update');
    }
}
