<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCancelled extends Notification implements ShouldQueue
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
            ->subject('Appointment Cancelled — '.$appointment->reference_number)
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('Your appointment has been cancelled.')
            ->line('**Reference:** '.$appointment->reference_number)
            ->line('**Date was:** '.$appointment->appointment_date->format('D, d M Y').' at '.$appointment->start_time)
            ->action('Book a New Appointment', route('appointments.book'))
            ->line('We hope to see you soon. Book a new appointment at your convenience.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'appointment_id' => $this->appointment->id,
            'reference_number' => $this->appointment->reference_number,
        ];
    }
}
