<?php

namespace App\Notifications;

use App\Models\Protest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProtestSubmitted extends Notification
{
    use Queueable;

    /**
     * @var Protest
     */
    private $protest;

    /**
     * Create a new notification instance.
     *
     * @param  Protest  $protest
     */
    public function __construct(Protest $protest)
    {
        $this->protest = $protest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line("There has been a new protest submitted by {$this->protest->driver->name} against {$this->protest->protestedDriver->name}")
                    ->action('Read Protest', url("/nova/resources/protests/{$this->protest->id}"));
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
