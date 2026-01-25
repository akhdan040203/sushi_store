<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccessNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Successful - ' . $this->order->order_number)
            ->greeting('Hello, ' . $this->order->customer_name . '!')
            ->line('Your order has been successfully placed.')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Total Amount: Rp ' . number_format($this->order->total, 0, ',', '.'))
            ->action('View Order Status', url('/items'))
            ->line('We are preparing your sushi right now. Thank you for choosing Sushi Store!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'amount' => $this->order->total,
            'message' => 'Your order #' . $this->order->order_number . ' was placed successfully.',
        ];
    }
}
