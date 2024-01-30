<?php

namespace App\Notifications;

use App\Http\Resources\Client\Notification\BanNotificationResource;
use App\Http\Resources\Client\Notification\PostNotificationResource;
use App\Models\BanList;
use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ViolatedSiteRules extends Notification
{
    use Queueable;

    public Report $report;
    public string $message;
    public $warn;
    public null|BanList $ban;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report, string $message, $warn, null|BanList $ban = null)
    {
        $this->report = $report;
        $this->message = $message;
        $this->warn = $warn;
        $this->ban = $ban;
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
            'object' => $this->report->object,
            'reason' => $this->report->reason->name,
            'post' => $this->report->post !==null ? new PostNotificationResource($this->report->post) : null,
            'topic' => $this->report->topic,
            'message' => $this->message,
            'warn' => $this->warn,
            'ban' => $this->ban !==null ? new BanNotificationResource($this->ban) : null,
        ];
    }
}
