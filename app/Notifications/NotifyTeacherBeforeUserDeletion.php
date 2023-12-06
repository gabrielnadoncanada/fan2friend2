<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyTeacherBeforeUserDeletion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
            ->subject('Avis de suppression des comptes d\'utilisateurs')
            ->line('Cher(e) enseignant(e),')
            ->line('Nous tenons à vous informer que les comptes d\'utilisateurs de votre groupe, dont la date d\'expiration dépasse 3 ans, seront supprimés dans deux semaines.')
            ->line('Si vous avez des questions ou des préoccupations, n\'hésitez pas à nous contacter.')
            ->action('Voir les comptes de mon groupe', url('/setting'))
            ->line('Merci de votre compréhension et de votre coopération.')
            ->line('Cordialement,')
            ->line('L\'équipe [Nom de votre application]');
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
