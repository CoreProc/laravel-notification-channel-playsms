<?php

namespace CoreProc\NotificationChannels\PlaySms;

use CoreProc\NotificationChannels\PlaySms\Exceptions\CouldNotSendNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PlaySmsClient
{
    private $client;
    private $apiKey;
    private $username;

    public function __construct($baseUrl, $username, $apiKey, $options = [])
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->client = new Client(array_merge(
            ['base_uri' => $baseUrl],
            $options
        ));
    }

    /**
     * @param $mobileNumber
     * @param $message
     * @throws CouldNotSendNotification
     */
    public function send($mobileNumber, $message)
    {
        try {
            $this->client->get('/index.php', [
                'query' => [
                    'app' => 'ws',
                    'u' => $this->username,
                    'h' => $this->apiKey,
                    'op' => 'pv',
                    'to' => $mobileNumber,
                    'msg' => $message,
                ],
            ]);
        } catch (RequestException $e) {
            throw new CouldNotSendNotification("Failed to call PlaySMS API. Endpoint responded with {$e->getCode()}.");
        }
    }
}
