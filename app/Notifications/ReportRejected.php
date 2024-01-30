<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Report;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportRejected extends Notification
{
    use Queueable;

    public Report $report;
    public string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report, string $message)
    {
        $this->report = $report;
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
            'userName' => $this->report->sender->getFullName(),
            'reportReasonType' => $this->report->reason->name,
            'object' => $this->report->object,
            'post' => [
                'postId' => $this->report->post->id,
                'topicId' => $this->report->post->topic->id,
                'topicTitle' => $this->report->post->topic->title,
            ],
            'topic' => $this->report->topic,
            'author' => [
                'id' => $this->report->userId,
                'name' => $this->report->user->getFullName(),
            ],
            'message' => $this->message,
        ];
    }
}
