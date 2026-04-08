<?php

namespace App\Livewire\Admin\Pets;

use App\Models\Pet;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class PetList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $pets = Pet::with('owner')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhereHas('owner', fn ($q) => $q->where('name', 'like', "%{$this->search}%")))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.pets.pet-list', compact('pets'));
    }
}
