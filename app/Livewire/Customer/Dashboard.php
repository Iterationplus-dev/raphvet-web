<?php

namespace App\Livewire\Customer;

use App\Models\Appointment;
use App\Models\Order;
use App\Models\Pet;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class Dashboard extends Component
{
    public function render(): View
    {
        $user = auth()->user();

        $petsCount = Pet::where('owner_id', $user->id)->count();

        $upcomingAppointments = Appointment::where('customer_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->count();

        $recentOrders = Order::where('customer_id', $user->id)
            ->latest()
            ->limit(3)
            ->get();

        $ordersCount = Order::where('customer_id', $user->id)->count();

        $nextAppointment = Appointment::where('customer_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('appointment_date', '>=', today())
            ->with(['vet', 'service', 'pet'])
            ->orderBy('appointment_date')
            ->orderBy('start_time')
            ->first();

        $recentPets = Pet::where('owner_id', $user->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('livewire.customer.dashboard', compact(
            'petsCount',
            'upcomingAppointments',
            'recentOrders',
            'ordersCount',
            'nextAppointment',
            'recentPets',
        ));
    }
}
