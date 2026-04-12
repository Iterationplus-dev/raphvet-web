<?php

namespace App\Livewire\Public;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ServicesList extends Component
{
    /** @var Collection<int, Service> */
    public Collection $services;

    public function mount(): void
    {
        $this->services = Service::active()->orderBy('sort_order')->get();
    }

    public function render(): View
    {
        return view('livewire.public.services-list')
            ->layout('components.layouts.app', [
                'title' => 'Our Services',
                'description' => 'Explore the full range of veterinary services at Raph Veterinary Services — from pet consultations and vaccinations to farm management, surgery, and livestock care across Nigeria.',
            ]);
    }
}
