<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification
{
    use Queueable;
    private string $password;
    private string $language;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $password, string $language)
    {
        $this->password = $password;
        $this->language = $language;
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
            ->subject($this->getText('notification.account.subject'))
            ->greeting($this->getText('notification.account.greeting'))
            ->line($this->getText('notification.account.line_hello') . $notifiable->first_name)
            ->line($this->getText('notification.account.line_email') . $notifiable->email)
            ->line($this->getText('notification.account.line_password') . $this->password)
            ->line($this->getText('notification.account.line_note'))
            ->action($this->getText('notification.account.action_login'), url('/login'));
    }

    private function getText(string $slug){
        return __($slug, [], $this->language);
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
