<?php

namespace App\Livewire\Pets;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class PetProfile extends Component
{
    public Pet $pet;

    public string $activeTab = 'overview';

    public function mount(Pet $pet): void
    {
        abort_if(auth()->id() !== $pet->owner_id, 403);

        $this->pet = $pet;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): View
    {
        $medicalRecords = new Collection;
        $vaccinations = new Collection;

        if ($this->activeTab === 'medical') {
            $medicalRecords = $this->pet
                ->medicalRecords()
                ->with('vet')
                ->latest('visit_date')
                ->get();
        }

        if ($this->activeTab === 'vaccinations') {
            $vaccinations = $this->pet
                ->vaccinations()
                ->with('vet')
                ->latest('administered_date')
                ->get();
        }

        return view('livewire.pets.pet-profile', compact('medicalRecords', 'vaccinations'));
    }
}
