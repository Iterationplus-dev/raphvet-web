<?php

namespace App\Livewire\Pets;

use App\Models\Pet;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class PetForm extends Component
{
    public string $name = '';

    public string $species = 'dog';

    public string $breed = '';

    public string $gender = 'unknown';

    public string $dateOfBirth = '';

    public string $weightKg = '';

    public string $color = '';

    public string $microchipNumber = '';

    public string $notes = '';

    public ?int $petId = null;

    public function mount(?Pet $pet = null): void
    {
        if ($pet && $pet->exists && $pet->owner_id === auth()->id()) {
            $this->petId = $pet->id;
            $this->name = $pet->name;
            $this->species = $pet->species;
            $this->breed = $pet->breed ?? '';
            $this->gender = $pet->gender;
            $this->dateOfBirth = $pet->date_of_birth?->format('Y-m-d') ?? '';
            $this->weightKg = $pet->weight_kg !== null ? (string) $pet->weight_kg : '';
            $this->color = $pet->color ?? '';
            $this->microchipNumber = $pet->microchip_number ?? '';
            $this->notes = $pet->notes ?? '';
        }
    }

    /**
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'species' => 'required|in:dog,cat,bird,rabbit,cattle,goat,pig,poultry,other',
            'breed' => 'nullable|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'dateOfBirth' => 'nullable|date|before:today',
            'weightKg' => 'nullable|numeric|min:0.01|max:9999',
            'color' => 'nullable|string|max:50',
            'microchipNumber' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $data = [
            'name' => $validated['name'],
            'species' => $validated['species'],
            'breed' => $validated['breed'] ?: null,
            'gender' => $validated['gender'],
            'date_of_birth' => $validated['dateOfBirth'] ?: null,
            'weight_kg' => $validated['weightKg'] ?: null,
            'color' => $validated['color'] ?: null,
            'microchip_number' => $validated['microchipNumber'] ?: null,
            'notes' => $validated['notes'] ?: null,
        ];

        if ($this->petId) {
            $pet = Pet::where('id', $this->petId)
                ->where('owner_id', auth()->id())
                ->firstOrFail();

            $pet->update($data);

            session()->flash('success', "{$pet->name} has been updated successfully.");

            $this->redirectRoute('my.pets.show', $pet);
        } else {
            $pet = auth()->user()->pets()->create($data);

            session()->flash('success', "{$pet->name} has been added to your pets.");

            $this->redirectRoute('my.pets.show', $pet);
        }
    }

    public function render(): View
    {
        return view('livewire.pets.pet-form', [
            'isEditing' => $this->petId !== null,
            'petTitle' => $this->name ?: 'New Pet',
        ]);
    }
}
