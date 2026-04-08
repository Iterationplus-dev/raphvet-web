<?php

namespace App\Livewire\Public;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
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
        return view('livewire.public.services-list');
    }
}
