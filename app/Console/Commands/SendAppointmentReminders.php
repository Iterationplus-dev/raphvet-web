<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Notifications\AppointmentReminder;
use Illuminate\Console\Command;

class SendAppointmentReminders extends Command
{
    protected $signature = 'vet:send-appointment-reminders';

    protected $description = 'Send 24-hour appointment reminder notifications to customers';

    public function handle(): int
    {
        $tomorrow = today()->addDay();

        $appointments = Appointment::query()
            ->with(['customer', 'vet', 'service', 'pet'])
            ->whereDate('appointment_date', $tomorrow)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereNull('reminder_sent_at')
            ->get();

        $sent = 0;

        foreach ($appointments as $appointment) {
            try {
                $appointment->customer->notify(new AppointmentReminder($appointment));
                $appointment->update(['reminder_sent_at' => now()]);
                $sent++;
            } catch (\Throwable $e) {
                $this->error("Failed for appointment #{$appointment->id}: {$e->getMessage()}");
            }
        }

        $this->info("Sent {$sent} appointment reminder(s).");

        return self::SUCCESS;
    }
}
