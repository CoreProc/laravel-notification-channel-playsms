<?php

namespace CoreProc\NotificationChannels\PlaySms;

class PlaySmsMessage
{
    private $message;

    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return PlaySmsMessage
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function __toString()
    {
        return $this->message;
    }
}
