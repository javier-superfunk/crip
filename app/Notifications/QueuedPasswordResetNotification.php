<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword;

class QueuedPasswordResetNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

    // al extender de ResetPassword ya no necesitamos implementar nada mas
}
