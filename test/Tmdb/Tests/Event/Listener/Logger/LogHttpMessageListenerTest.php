<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Tests\Event\Listener\Logger;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use Http\Mock\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientExceptionInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\HttpClientExceptionEvent;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\HttpClient\HttpClient;
use WMDE\PsrLogTestDoubles\LoggerSpy;

class LogHttpMessageListenerTest extends LoggerListenerTestCase
{
    /**
     * @test
     */
    public function shouldLogRequest()
    {
        $logger = new LoggerSpy();

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'http://www.test.com/foo/bar');
        $event = new RequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(new HttpClient(['http' => ['client' => new Client()]]), $eventDispatcher)
        );
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new \Tmdb\Event\Listener\Logger\LogHttpMessageListener($logger)
        );
        $eventDispatcher->dispatch($event);

        $expectedMessage = <<<HEADER
Sending request:
GET http://www.test.com/foo/bar 1.1
HEADER;

        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame([$expectedMessage], $logger->getLogCalls()->getMessages());
    }

    /**
     * @test
     */
    public function shouldLogResponse()
    {
        $logger = new LoggerSpy();

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'http://www.test.com/foo/bar');
        $response = $factory->createResponse(200);
        $event = new ResponseEvent($response, $request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(new HttpClient(['http' => ['client' => new Client()]]), $eventDispatcher)
        );
        $eventDispatcher->addListener(
            ResponseEvent::class,
            new \Tmdb\Event\Listener\Logger\LogHttpMessageListener($logger)
        );
        $eventDispatcher->dispatch($event);

        $expectedMessage = <<<HEADER
Received response:
200 OK 1.1
HEADER;

        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame([$expectedMessage], $logger->getLogCalls()->getMessages());
    }

    /**
     * @test
     */
    public function shouldLogClientException()
    {
        $logger = new LoggerSpy();

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'http://www.test.com/foo/bar');
        $exception = new ConnectException('connection exception', $request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            HttpClientExceptionEvent::class,
            new \Tmdb\Event\Listener\Logger\LogHttpMessageListener($logger)
        );
        $eventDispatcher->dispatch(new HttpClientExceptionEvent($exception, $request));

        $expectedMessage = <<<HEADER
Critical http client error:
0 connection exception
HEADER;

        $this->assertCount(1, $logger->getLogCalls());
        $this->assertSame([$expectedMessage], $logger->getLogCalls()->getMessages());
    }
}
