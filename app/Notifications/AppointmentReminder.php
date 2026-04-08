<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Appointment $appointment) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appointment = $this->appointment;

        return (new MailMessage)
            ->subject('Reminder: Appointment Tomorrow — '.$appointment->reference_number)
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('This is a friendly reminder that you have an appointment **tomorrow**.')
            ->line('**Date:** '.$appointment->appointment_date->format('D, d M Y'))
            ->line('**Time:** '.$appointment->start_time)
            ->line('**Vet:** Dr. '.$appointment->vet->name)
            ->line('**Service:** '.($appointment->service?->name ?? 'General Consultation'))
            ->action('View Appointment', route('my.appointments.show', $appointment->reference_number))
            ->line('Please arrive 10 minutes early. Need to cancel? Contact us as soon as possible.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'reference_number' => $this->appointment->reference_number,
        ];
    }
}
