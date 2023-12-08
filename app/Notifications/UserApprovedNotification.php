<?php

namespace App\Notifications;

use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification
{
    use Queueable;

    public $token;

    public string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = Filament::getResetPasswordUrl($this->token, $notifiable);

        return (new MailMessage)
            ->subject('Notification d\'approbation de compte')
            ->greeting('Bonjour,')
            ->line('Vous recevez ce courriel car votre compte a été approuvé.')
            ->line('Vous pouvez utiliser le lien ci-dessous pour aller sur la page de connexion.')
            ->action('Définir le Mot de Passe', $resetUrl)
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
