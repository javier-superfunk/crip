<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;

class QueuedEmailVerificationNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    // no necesitamos nada mas porque ya se extiende de SendEmailVerificationNotification
}
