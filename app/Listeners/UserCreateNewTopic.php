<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\CreateNewTopic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreateNewTopic
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('slug', '=', 'admin')
                ->orWhere('slug', '=', 'moderator');
        })->get();
        Notification::send($users, new CreateNewTopic($event->user, $event->topic));
    }
}
