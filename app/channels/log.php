<?php

namespace App\channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log as LogFacades;

class log
{
    public function send($notifiable , Notification $notification )
    {
        $message = $notification->toLog($notifiable);
        LogFacades::info("[$notifiable->name]:$message" );
    }
}
