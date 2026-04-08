<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\ContactSubmission;
use App\Models\Order;
use App\Models\Pet;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'totalPets' => Pet::count(),
            'appointmentsToday' => Appointment::whereDate('appointment_date', today())->count(),
            'ordersThisWeek' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'revenueThisMonth' => Order::where('payment_status', 'paid')->whereMonth('created_at', now()->month)->sum('total_amount'),
            'pendingContacts' => ContactSubmission::where('is_read', false)->count(),
            'recentAppointments' => Appointment::with(['customer', 'pet', 'service'])->latest()->take(5)->get(),
            'recentOrders' => Order::with('customer')->latest()->take(5)->get(),
        ]);
    }
}
