<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\VaccinationReminder;
use App\Notifications\VaccinationDueReminder;
use Illuminate\Console\Command;

class SendVaccinationReminders extends Command
{
    protected $signature = 'vet:send-vaccination-reminders';

    protected $description = 'Send vaccination due reminder notifications to pet owners';

    public function handle(): int
    {
        $reminders = VaccinationReminder::query()
            ->with(['owner', 'vaccination', 'pet'])
            ->where('reminder_date', today())
            ->where('status', 'pending')
            ->get();

        $sent = 0;

        foreach ($reminders as $reminder) {
            try {
                $reminder->owner->notify(new VaccinationDueReminder($reminder));

                $reminder->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);

                $sent++;
            } catch (\Throwable $e) {
                $reminder->update(['status' => 'failed']);
                $this->error("Failed for reminder #{$reminder->id}: {$e->getMessage()}");
            }
        }

        $this->info("Sent {$sent} vaccination reminder(s).");

        return self::SUCCESS;
    }
}
