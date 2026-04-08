<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\VaccinationReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccinationDueReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly VaccinationReminder $reminder) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $vaccination = $this->reminder->vaccination;
        $pet = $this->reminder->pet;

        return (new MailMessage)
            ->subject('Vaccination Due: '.$vaccination->vaccine_name.' for '.$pet->name)
            ->greeting('Hello '.$notifiable->name.'!')
            ->line("This is a reminder that **{$pet->name}** is due for a vaccination.")
            ->line('**Vaccine:** '.$vaccination->vaccine_name)
            ->line('**Due Date:** '.$vaccination->next_due_date?->format('D, d M Y'))
            ->line('**Pet:** '.$pet->name.' ('.ucfirst($pet->species).')')
            ->action('Book Vaccination Appointment', route('appointments.book'))
            ->line('Keep your pet healthy — book an appointment today!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'pet_id' => $this->reminder->pet_id,
            'vaccine_name' => $this->reminder->vaccination->vaccine_name,
            'due_date' => $this->reminder->vaccination->next_due_date?->toDateString(),
        ];
    }
}
