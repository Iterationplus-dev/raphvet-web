<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AppointmentList extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = 'all';

    public string $dateFilter = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatedDateFilter(): void
    {
        $this->resetPage();
    }

    public function updateStatus(int $id, string $status): void
    {
        $appt = Appointment::findOrFail($id);
        $old = $appt->status;
        $appt->update(['status' => $status]);
        AppointmentStatusLog::create([
            'appointment_id' => $id,
            'changed_by' => auth()->id(),
            'from_status' => $old,
            'to_status' => $status,
        ]);
    }

    public function render(): View
    {
        $appointments = Appointment::with(['customer', 'vet', 'pet', 'service'])
            ->when($this->search, fn ($q) => $q->whereHas('customer', fn ($q) => $q->where('name', 'like', "%{$this->search}%")))
            ->when($this->statusFilter !== 'all', fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->dateFilter, fn ($q) => $q->whereDate('appointment_date', $this->dateFilter))
            ->latest('appointment_date')
            ->paginate(15);

        return view('livewire.admin.appointments.appointment-list', compact('appointments'));
    }
}
