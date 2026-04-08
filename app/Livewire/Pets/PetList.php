<?php

namespace App\Livewire\Pets;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.customer')]
class PetList extends Component
{
    use WithPagination;

    public function render(): View
    {
        $pets = auth()->user()
            ->pets()
            ->latest()
            ->paginate(12);

        return view('livewire.pets.pet-list', compact('pets'));
    }
}
