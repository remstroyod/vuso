<?php

namespace Frontend\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class UserContractNotification extends Notification
{
    use Queueable;

    private EdocumentUser $contract;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EdocumentUser $contract)
    {
        $this->contract = $contract;

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
        info($this->contract->path . ' dogovor to email....');
        $file = Storage::disk('google')->get($this->contract->path);
        return (new MailMessage)
                    ->line('Договор: №' . $this->contract->dogovor_id)
                    ->attachData($file, 'test.pdf' ,['mime' => $this->contract->mimetype]);
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
            //
        ];
    }
}
