<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\AppointmentStatusLog;
use App\Models\Service;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class BookingWizard extends Component
{
    public int $step = 1;

    public ?int $selectedServiceId = null;

    public ?int $selectedVetId = null;

    public string $selectedDate = '';

    public string $selectedTime = '';

    public ?int $selectedPetId = null;

    public string $type = 'in_clinic';

    public string $reason = '';

    public string $notes = '';

    public array $availableSlots = [];

    // Guest fields (used when unauthenticated)
    public string $guestName = '';

    public string $guestEmail = '';

    public string $guestPhone = '';

    public ?string $bookedReference = null;

    public function mount(): void
    {
        $this->availableSlots = [];

        if (auth()->check()) {
            $this->guestName = auth()->user()->name;
            $this->guestEmail = auth()->user()->email;
            $this->guestPhone = auth()->user()->phone ?? '';
        }
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'selectedServiceId' => 'required|integer|exists:services,id',
            ], [
                'selectedServiceId.required' => 'Please select a service.',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'selectedVetId' => 'required|integer|exists:users,id',
                'selectedDate' => 'required|date|after_or_equal:today',
                'selectedTime' => 'required|string',
            ], [
                'selectedVetId.required' => 'Please select a veterinarian.',
                'selectedDate.required' => 'Please select a date.',
                'selectedDate.after_or_equal' => 'The appointment date must be today or in the future.',
                'selectedTime.required' => 'Please select a time slot.',
            ]);
        } elseif ($this->step === 3) {
            $rules = [
                'reason' => 'required|string|min:10|max:1000',
                'type' => 'required|in:in_clinic,farm_visit,online',
            ];

            if (! auth()->check()) {
                $rules['guestName'] = 'required|string|max:100';
                $rules['guestEmail'] = 'required|email|max:150';
                $rules['guestPhone'] = 'required|string|max:20';
            }

            $this->validate($rules, [
                'reason.required' => 'Please describe the reason for your visit.',
                'reason.min' => 'The reason must be at least 10 characters.',
                'guestName.required' => 'Please enter your full name.',
                'guestEmail.required' => 'Please enter your email address.',
                'guestPhone.required' => 'Please enter your phone number.',
            ]);
        }

        if ($this->step < 4) {
            $this->step++;
        }
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function updatedSelectedDate(): void
    {
        $this->calculateSlots();
    }

    public function updatedSelectedVetId(): void
    {
        $this->selectedTime = '';
        $this->calculateSlots();
    }

    private function calculateSlots(): void
    {
        $this->availableSlots = [];

        if (! $this->selectedVetId || ! $this->selectedDate) {
            return;
        }

        $bookedTimes = Appointment::where('vet_id', $this->selectedVetId)
            ->whereDate('appointment_date', $this->selectedDate)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('start_time')
            ->map(fn ($time) => substr($time, 0, 5))
            ->toArray();

        $slots = [];
        for ($hour = 8; $hour <= 16; $hour++) {
            $value = sprintf('%02d:00', $hour);
            $display = date('h:i A', strtotime($value));

            $slots[] = [
                'value' => $value,
                'display' => $display,
                'available' => ! in_array($value, $bookedTimes),
            ];
        }

        $this->availableSlots = $slots;
    }

    public function book(): void
    {
        $rules = [
            'selectedServiceId' => 'required|integer|exists:services,id',
            'selectedVetId' => 'required|integer|exists:users,id',
            'selectedDate' => 'required|date|after_or_equal:today',
            'selectedTime' => 'required|string',
            'reason' => 'required|string|min:10|max:1000',
            'type' => 'required|in:in_clinic,farm_visit,online',
            'selectedPetId' => 'nullable|integer|exists:pets,id',
        ];

        if (! auth()->check()) {
            $rules['guestName'] = 'required|string|max:100';
            $rules['guestEmail'] = 'required|email|max:150';
            $rules['guestPhone'] = 'required|string|max:20';
        }

        $this->validate($rules);

        $vet = User::find($this->selectedVetId);

        $startTime = $this->selectedTime;
        $endTime = date('H:i', strtotime('+1 hour', strtotime($startTime)));

        $appointment = Appointment::create([
            'reference_number' => Appointment::generateReference(),
            'customer_id' => auth()->id(),
            'guest_name' => auth()->check() ? null : $this->guestName,
            'guest_email' => auth()->check() ? null : $this->guestEmail,
            'guest_phone' => auth()->check() ? null : $this->guestPhone,
            'vet_id' => $this->selectedVetId,
            'pet_id' => auth()->check() ? $this->selectedPetId : null,
            'service_id' => $this->selectedServiceId,
            'appointment_date' => $this->selectedDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'pending',
            'type' => $this->type,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'total_amount' => $vet?->vetProfile?->consultation_fee ?? 0,
        ]);

        AppointmentStatusLog::create([
            'appointment_id' => $appointment->id,
            'changed_by' => auth()->id(),
            'from_status' => null,
            'to_status' => 'pending',
            'notes' => auth()->check() ? 'Appointment booked by customer.' : 'Appointment booked by guest.',
        ]);

        $this->bookedReference = $appointment->reference_number;
        $this->step = 5; // success step
    }

    public function render(): View
    {
        $services = Service::active()->get();

        $vets = User::role('vet')
            ->with('vetProfile')
            ->where('is_active', true)
            ->get();

        $pets = auth()->check()
            ? auth()->user()->pets()->where('is_active', true)->get()
            : collect();

        return view('livewire.appointments.booking-wizard', [
            'services' => $services,
            'vets' => $vets,
            'pets' => $pets,
        ]);
    }
}
