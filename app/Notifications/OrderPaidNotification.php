<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPaidNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Order is Paid')
            ->greeting('Hello!')
            ->line('Your order has been successfully paid.')
            ->action(
                'View Order',
                route('celebrity.waiting-room', ['category' => $this->order->orderItems()->first()->celebrity->category->slug, 'celebrity' => $this->order->orderItems()->first()->celebrity])
            )
            ->line('Thank you for your purchase!');
    }
}
