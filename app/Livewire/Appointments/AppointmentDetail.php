<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class AppointmentDetail extends Component
{
    public Appointment $appointment;

    public function mount(string $reference): void
    {
        $this->appointment = Appointment::with(['service', 'vet.vetProfile', 'pet', 'statusLogs.changedBy'])
            ->where('reference_number', $reference)
            ->firstOrFail();

        if ($this->appointment->customer_id !== auth()->id()) {
            abort(403);
        }
    }

    public function cancel(): void
    {
        if (! $this->appointment->isCancellable()) {
            session()->flash('error', 'This appointment cannot be cancelled.');

            return;
        }

        $fromStatus = $this->appointment->status;

        $this->appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        AppointmentStatusLog::create([
            'appointment_id' => $this->appointment->id,
            'changed_by' => auth()->id(),
            'from_status' => $fromStatus,
            'to_status' => 'cancelled',
            'notes' => 'Cancelled by customer.',
        ]);

        $this->appointment->refresh();

        session()->flash('success', 'Your appointment has been cancelled.');
    }

    public function render(): View
    {
        return view('livewire.appointments.appointment-detail');
    }
}
