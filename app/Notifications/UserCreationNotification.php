<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreationNotification extends Notification
{
    use Queueable;

    public $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Notification de création de compte')
            ->greeting('Bonjour,')
            ->line('Vous recevez ce courriel car un compte utilisateur a été créé pour vous.')
            ->line('Veuillez suivre le lien suivant pour créer votre mot de passe.')
            ->action('Créer mon mot de passe', $this->url)
            ->line('Merci d\'utiliser notre plateforme');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
