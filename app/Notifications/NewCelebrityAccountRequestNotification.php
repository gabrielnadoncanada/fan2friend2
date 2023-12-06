<?php

namespace App\Notifications;

use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCelebrityAccountRequestNotification extends Notification implements ShouldQueue
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
            ->subject('Bienvenue ! Définissez Votre Mot de Passe')
            ->line('Bienvenue dans notre plateforme! Nous sommes heureux de vous compter parmi nous.')
            ->line('Pour accéder à votre compte, vous devez d\'abord définir votre mot de passe . ')
            ->action('Définir le Mot de Passe', $resetUrl)
            ->line("Cliquez sur le bouton ci-dessus pour choisir votre mot de passe. Si vous n'avez pas créé de compte, aucune autre action n'est requise.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Additional data for the notification can go here
        ];
    }
}
