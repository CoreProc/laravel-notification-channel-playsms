<?php

namespace NotificationChannels\PlaySms;

use Illuminate\Support\Arr;

class PlaySmsMessage
{
    private $message = '';

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function __toString()
    {
        return $this->message;
    }
}
