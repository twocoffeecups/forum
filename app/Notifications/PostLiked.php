<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLiked extends Notification
{
    use Queueable;

    public User $user;
    public Post $post;
    public Topic $topic;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Post $post, Topic $topic)
    {
        $this->user = $user;
        $this->post = $post;
        $this->topic = $topic;
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
            'userId'    => $this->user->id,
            'userName'  => $this->user->getFullName(),
            'postId'    => $this->post->id,
            'topicId'   => $this->topic->id,
            'topicTitle' => $this->topic->title,
        ];
    }
}
