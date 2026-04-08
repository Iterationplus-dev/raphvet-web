<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ServiceList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => ! $service->is_active]);
    }

    public function delete(int $id): void
    {
        Service::findOrFail($id)->delete();
    }

    public function render(): View
    {
        $services = Service::withCount('appointments')
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('sort_order')
            ->paginate(15);

        return view('livewire.admin.services.service-list', compact('services'));
    }
}
