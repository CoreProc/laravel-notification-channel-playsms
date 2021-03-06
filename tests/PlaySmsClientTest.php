<?php

namespace CoreProc\NotificationChannels\PlaySms\Test;

use CoreProc\NotificationChannels\PlaySms\PlaySmsClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use function GuzzleHttp\Psr7\parse_query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class PlaySmsClientTest extends TestCase
{
    /** @test */
    public function send_calls_to_outgoing_url()
    {
        $history = [];
        $handler = HandlerStack::create(new MockHandler([new Response()]));
        $handler->push(Middleware::history($history));

        $playSms = new PlaySmsClient(
            'http://localhost',
            'username',
            'apikey',
            compact('handler')
        );

        $playSms->send('09876543210', 'Test message');

        /** @var Request $request */
        $request = $history[0]['request'];

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/index.php', $request->getUri()->getPath());
        $this->assertEquals(
            [
                'app' => 'ws',
                'u' => 'username',
                'h' => 'apikey',
                'op' => 'pv',
                'to' => '09876543210',
                'msg' => 'Test message',
            ],
            parse_query($request->getUri()->getQuery())
        );
    }
}
