<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class OrderList extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updateStatus(int $id, string $status): void
    {
        Order::findOrFail($id)->update(['status' => $status]);
    }

    public function render(): View
    {
        $orders = Order::with('customer')
            ->when($this->search, fn ($q) => $q->where('reference_number', 'like', "%{$this->search}%")
                ->orWhereHas('customer', fn ($q) => $q->where('name', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== 'all', fn ($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.orders.order-list', compact('orders'));
    }
}
