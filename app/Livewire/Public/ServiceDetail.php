<?php

namespace App\Livewire\Public;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;

class ServiceDetail extends Component
{
    public Service $service;

    public function mount(string $slug): void
    {
        $this->service = Service::where('slug', $slug)->firstOrFail();
    }

    public function render(): View
    {
        $title = $this->service->meta_title ?: $this->service->name;
        $description = $this->service->meta_description
            ?: ($this->service->short_description ?: 'Professional '.$this->service->name.' veterinary service in Nigeria. Book an appointment with Raph Veterinary Services today.');

        return view('livewire.public.service-detail', [
            'relatedServices' => Service::active()
                ->where('id', '!=', $this->service->id)
                ->take(3)
                ->get(),
        ])->layout('components.layouts.app', [
            'title' => $title,
            'description' => $description,
        ]);
    }
}
