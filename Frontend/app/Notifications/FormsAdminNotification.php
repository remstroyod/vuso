<?php

namespace Frontend\Notifications;

use Frontend\Models\FormsData;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormsAdminNotification extends Notification
{
    use Queueable;

    private $forms;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(FormsData $formsData)
    {
        $this->forms = $formsData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail', 'broadcast' ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Имя: ' . $this->forms->name)
                    ->line('E-mail: ' . $this->forms->email)
                    ->line('Текст: ' . $this->forms->message)
                    ->action('Просмотр', settings('site_url') . '/forms/reviews');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->forms->name,
            'email' => $this->forms->email,
            'message' => $this->forms->message,
        ];
    }
}
