<?php

namespace App\Notifications;

use App\Models\Protest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class ProtestReviewComplete extends Notification
{
    use Queueable;

    /**
     * @var Protest
     */
    private $protest;

    /**
     * Create a new notification instance.
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
        return ['mail', DiscordChannel::class];
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
            ->line('A decision has been reached on your protest.')
            ->action('Read Decision', route('profile.protests'));
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create()
            ->embed([
                'title' => "Protest #{$this->protest->id}",
                'description' => $this->protest->stewards_decision,
                'url' => route('races.protests', $this->protest->race_id),
                'fields' => [
                    ['name' => 'Driver', 'value' => $this->protest->driver->name],
                    ['name' => 'Protested Driver', 'value' => $this->protest->protestedDriver->name],
                    ['name' => 'Track', 'value' => $this->protest->race->track->name],
                    ['name' => 'Video Evidence', 'value' => $this->protest->video_url]
                ]
            ]);
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
