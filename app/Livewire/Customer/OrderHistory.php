<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.customer')]
class OrderHistory extends Component
{
    use WithPagination;

    public function render(): View
    {
        $orders = Order::where('customer_id', auth()->id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('livewire.customer.order-history', compact('orders'));
    }
}
