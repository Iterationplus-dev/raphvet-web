<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Order $order) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $order = $this->order;

        return (new MailMessage)
            ->subject('Order Confirmed — '.$order->reference_number)
            ->greeting('Thank you for your order, '.$notifiable->name.'!')
            ->line('We have received your order and are processing it.')
            ->line('**Order Reference:** '.$order->reference_number)
            ->line('**Total:** ₦'.number_format((float) $order->total_amount, 2))
            ->line('**Shipping to:** '.$order->shipping_city.', '.$order->shipping_state)
            ->action('View Order', route('my.orders'))
            ->line('You will receive another email when your order ships. Thank you for choosing Raph Veterinary Services!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'reference_number' => $this->order->reference_number,
            'total_amount' => $this->order->total_amount,
        ];
    }
}
