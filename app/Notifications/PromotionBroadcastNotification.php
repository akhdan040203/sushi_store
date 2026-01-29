<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromotionBroadcastNotification extends Notification
{
    use Queueable;

    protected $messageTitle;
    protected $messageBody;
    protected $actionUrl;
    protected $imageUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $body, $actionUrl = null, $imageUrl = null)
    {
        $this->messageTitle = $title;
        $this->messageBody = $body;
        $this->actionUrl = $actionUrl;
        $this->imageUrl = $imageUrl;
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
            ->subject($this->messageTitle)
            ->markdown('mail.promotion', [
                'title' => $this->messageTitle,
                'body' => $this->messageBody,
                'image' => $this->imageUrl ? asset('storage/' . $this->imageUrl) : null,
                'url' => $this->actionUrl ? url($this->actionUrl) : url('/items'),
                'buttonText' => $this->actionUrl ? 'Check Product' : 'Order Now'
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->messageTitle,
            'body' => $this->messageBody,
            'action_url' => $this->actionUrl,
            'image_url' => $this->imageUrl,
            'type' => 'promotion',
        ];
    }
}
