<?php

namespace App\Livewire\Public;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ServiceDetail extends Component
{
    public Service $service;

    public function mount(string $slug): void
    {
        $this->service = Service::where('slug', $slug)->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.public.service-detail', [
            'relatedServices' => Service::active()
                ->where('id', '!=', $this->service->id)
                ->take(3)
                ->get(),
        ]);
    }
}
