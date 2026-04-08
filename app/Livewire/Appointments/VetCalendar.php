<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.customer')]
class VetCalendar extends Component
{
    public string $date;

    public function mount(): void
    {
        $this->date = today()->toDateString();
    }

    public function previousDay(): void
    {
        $this->date = Carbon::parse($this->date)->subDay()->toDateString();
    }

    public function nextDay(): void
    {
        $this->date = Carbon::parse($this->date)->addDay()->toDateString();
    }

    public function markComplete(int $appointmentId): void
    {
        $appointment = Appointment::where('vet_id', auth()->id())
            ->findOrFail($appointmentId);

        $fromStatus = $appointment->status;

        $appointment->update(['status' => 'completed']);

        AppointmentStatusLog::create([
            'appointment_id' => $appointment->id,
            'changed_by' => auth()->id(),
            'from_status' => $fromStatus,
            'to_status' => 'completed',
            'notes' => 'Marked complete by vet.',
        ]);

        session()->flash('success', 'Appointment marked as completed.');
    }

    public function render(): View
    {
        $appointments = Appointment::with(['customer', 'pet', 'service'])
            ->where('vet_id', auth()->id())
            ->whereDate('appointment_date', $this->date)
            ->orderBy('start_time')
            ->get()
            ->keyBy(fn ($appt) => substr($appt->start_time, 0, 5));

        $slots = [];
        for ($hour = 8; $hour <= 16; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
        }

        return view('livewire.appointments.vet-calendar', [
            'appointments' => $appointments,
            'slots' => $slots,
        ]);
    }
}
