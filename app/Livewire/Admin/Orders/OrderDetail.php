<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class OrderDetail extends Component
{
    public string $reference = '';

    public Order $order;

    public string $newStatus = '';

    public function mount(string $reference): void
    {
        $this->reference = $reference;
        $this->order = Order::with(['customer', 'items.product'])
            ->where('reference_number', $reference)
            ->firstOrFail();
        $this->newStatus = $this->order->status;
    }

    public function updateStatus(): void
    {
        $this->validate(['newStatus' => 'required|in:pending,processing,shipped,delivered,cancelled']);

        $this->order->update(['status' => $this->newStatus]);
        $this->order->refresh()->load(['customer', 'items.product']);

        session()->flash('success', 'Order status updated.');
    }

    public function render(): View
    {
        return view('livewire.admin.orders.order-detail');
    }
}
