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

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $body, $actionUrl = null)
    {
        $this->messageTitle = $title;
        $this->messageBody = $body;
        $this->actionUrl = $actionUrl;
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
        $mail = (new MailMessage)
            ->subject($this->messageTitle)
            ->greeting('Special Promotion for ' . $notifiable->name . '!')
            ->line($this->messageBody);
            
        if ($this->actionUrl) {
            $mail->action('Check Product', url($this->actionUrl));
        } else {
            $mail->action('Order Now', url('/items'));
        }

        return $mail->line('Thank you for being our loyal customer! Enjoy your sushi.');
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
            'type' => 'promotion',
        ];
    }
}
