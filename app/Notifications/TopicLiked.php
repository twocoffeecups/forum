<?php

namespace App\Notifications;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TopicLiked extends Notification
{
    use Queueable;

    protected Topic $topic;
    protected User $user;
    /**
     * Create a new notification instance.
     */
    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
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
            'userId' => $this->user->id,
            'userName' => $this->user->name,
            'topicId' => $this->topic->id,
            'topicTitle' => $this->topic->title,
        ];
    }
}
