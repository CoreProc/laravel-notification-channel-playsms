<?php

namespace NotificationChannels\PlaySms;

use NotificationChannels\PlaySms\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class PlaySmsChannel
{
    private $playsms;

    public function __construct(PlaySmsClient $playsms)
    {
        $this->playsms = $playsms;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\PlaySms\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toPlaySms($notifiable);
        $recipient = $notifiable->routeNotificationForPlaySms($notification);

        $this->playsms->send($recipient, $message);
    }
}
