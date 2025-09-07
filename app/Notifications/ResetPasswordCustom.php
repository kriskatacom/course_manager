<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordCustom extends Notification
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Смяна на парола')
            ->line('Натиснете бутона, за да смените паролата си.')
            ->action('Смяна на парола', $this->url);
    }
}
