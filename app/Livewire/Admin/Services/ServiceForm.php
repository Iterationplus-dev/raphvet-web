<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class ServiceForm extends Component
{
    public string $name = '';

    public string $slug = '';

    public string $description = '';

    public string $shortDescription = '';

    public string $category = 'treatment';

    public bool $isActive = true;

    public int $sortOrder = 0;

    public string $metaTitle = '';

    public string $metaDescription = '';

    public ?int $serviceId = null;

    public function mount(?Service $service = null): void
    {
        if ($service && $service->exists) {
            $this->serviceId = $service->id;
            $this->name = $service->name;
            $this->slug = $service->slug;
            $this->description = $service->description ?? '';
            $this->shortDescription = $service->short_description ?? '';
            $this->category = $service->category ?? 'treatment';
            $this->isActive = $service->is_active;
            $this->sortOrder = $service->sort_order;
            $this->metaTitle = $service->meta_title ?? '';
            $this->metaDescription = $service->meta_description ?? '';
        }
    }

    public function updatedName(): void
    {
        if (! $this->serviceId) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:services,slug'.($this->serviceId ? ",{$this->serviceId}" : ''),
            'description' => 'nullable|string',
            'shortDescription' => 'nullable|string|max:500',
            'category' => 'required|string|max:100',
            'isActive' => 'boolean',
            'sortOrder' => 'integer|min:0',
            'metaTitle' => 'nullable|string|max:160',
            'metaDescription' => 'nullable|string|max:320',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->shortDescription,
            'category' => $this->category,
            'is_active' => $this->isActive,
            'sort_order' => $this->sortOrder,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
        ];

        if ($this->serviceId) {
            Service::findOrFail($this->serviceId)->update($data);
        } else {
            Service::create($data);
        }

        session()->flash('success', 'Service saved successfully.');
        $this->redirect(route('admin.services'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.services.service-form');
    }
}
