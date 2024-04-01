<?php

namespace App\Listeners;

use App\Notifications\CreateNewReport;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreateNewReport
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
        Notification::send($users, new CreateNewReport($event->report, $event->user));
    }
}
