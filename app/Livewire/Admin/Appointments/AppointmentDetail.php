<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class AppointmentDetail extends Component
{
    public string $reference = '';

    public Appointment $appointment;

    public string $newStatus = '';

    public function mount(string $reference): void
    {
        $this->reference = $reference;
        $this->appointment = Appointment::with(['customer', 'vet', 'pet', 'service', 'statusLogs.changedBy'])
            ->where('reference_number', $reference)
            ->firstOrFail();
        $this->newStatus = $this->appointment->status;
    }

    public function updateStatus(): void
    {
        $this->validate(['newStatus' => 'required|in:pending,confirmed,completed,cancelled']);

        $old = $this->appointment->status;
        $this->appointment->update(['status' => $this->newStatus]);

        AppointmentStatusLog::create([
            'appointment_id' => $this->appointment->id,
            'changed_by' => auth()->id(),
            'from_status' => $old,
            'to_status' => $this->newStatus,
        ]);

        $this->appointment->refresh()->load(['customer', 'vet', 'pet', 'service', 'statusLogs.changedBy']);

        session()->flash('success', 'Appointment status updated.');
    }

    public function render(): View
    {
        return view('livewire.admin.appointments.appointment-detail');
    }
}
