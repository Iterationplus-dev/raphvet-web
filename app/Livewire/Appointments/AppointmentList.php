<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.customer')]
class AppointmentList extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function cancel(int $appointmentId): void
    {
        $appointment = Appointment::where('customer_id', auth()->id())
            ->findOrFail($appointmentId);

        if (! $appointment->isCancellable()) {
            session()->flash('error', 'This appointment cannot be cancelled.');

            return;
        }

        $fromStatus = $appointment->status;

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        AppointmentStatusLog::create([
            'appointment_id' => $appointment->id,
            'changed_by' => auth()->id(),
            'from_status' => $fromStatus,
            'to_status' => 'cancelled',
            'notes' => 'Cancelled by customer.',
        ]);

        session()->flash('success', 'Appointment cancelled successfully.');
    }

    public function render(): View
    {
        $query = Appointment::with(['service', 'vet', 'pet'])
            ->where('customer_id', auth()->id())
            ->orderByDesc('appointment_date')
            ->orderByDesc('start_time');

        if ($this->statusFilter === 'upcoming') {
            $query->upcoming();
        } elseif ($this->statusFilter === 'past') {
            $query->whereDate('appointment_date', '<', today())
                ->orWhere(function ($q): void {
                    $q->whereDate('appointment_date', today())
                        ->whereIn('status', ['completed', 'no_show', 'cancelled']);
                });
        } elseif ($this->statusFilter === 'cancelled') {
            $query->where('status', 'cancelled');
        }

        $appointments = $query->paginate(10);

        return view('livewire.appointments.appointment-list', [
            'appointments' => $appointments,
        ]);
    }
}
