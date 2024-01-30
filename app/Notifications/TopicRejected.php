<?php

namespace App\Notifications;

use App\Http\Resources\Client\Notification\RejectedTopicNotificationResource;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TopicRejected extends Notification
{
    use Queueable;

    protected Topic $topic;
    protected null|string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Topic $topic, string|null $message)
    {
        $this->topic = $topic;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'topic' => new RejectedTopicNotificationResource($this->topic),
            'message' => $this->message,
        ];
    }
}
