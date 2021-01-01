<?php

namespace Tmdb\Tests\Event\Listener;

use Http\Mock\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Event\ResponseEvent;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Exception\UnexpectedResponseException;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Tests\TestCase;

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
class RequestListenerTest extends TestCase
{
    /**
     * @test
     */
    public function canReturnEarlyResponse()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event = new RequestEvent($request);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(new HttpClient(), $eventDispatcher)
        );
        $eventDispatcher->addListener(
            BeforeRequestEvent::class,
            new FakeTestListener()
        );
        $eventDispatcher->dispatch($event);
        $response = $event->getResponse();

        $this->assertEquals(301, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function testResponseEventIsFunctional()
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com/foo/bar');
        $event = new RequestEvent($request);

        $response = $factory->createResponse(200);
        $response = $response->withHeader('content-type', 'application/json; charset=utf-8');

        $client = new Client();
        $client->addResponse($response);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(
                new HttpClient(
                    [
                        'http' => [
                            'client' => $client
                        ]
                    ]
                ),
                $eventDispatcher
            )
        );
        $eventDispatcher->addListener(
            ResponseEvent::class,
            function (ResponseEvent $event) {
                $this->assertTrue($event->hasRequest());
                $this->assertInstanceOf(RequestInterface::class, $event->getRequest());
                $this->assertEquals('/foo/bar', $event->getRequest()->getUri()->getPath());

                $event->setRequest(
                    $event->getRequest()->withProtocolVersion('1.0')
                );
                $this->assertEquals('1.0', $event->getRequest()->getProtocolVersion());

                $this->assertTrue($event->hasResponse());
                $this->assertInstanceOf(ResponseInterface::class, $event->getResponse());
                $this->assertEquals(200, $event->getResponse()->getStatusCode());

                $event->setResponse(
                    $event->getResponse()->withStatus(418)
                );

                $this->assertEquals(418, $event->getResponse()->getStatusCode());
            }
        );

        $eventDispatcher->dispatch($event);
    }

    /**
     * @test
     */
    public function verifyItThrowsTmdbApiException()
    {
        $this->expectException(TmdbApiException::class);
        $this->expectExceptionCode(7);
        $this->expectExceptionMessage('Invalid API key: You must be granted a valid key.');

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event = new RequestEvent($request);

        $response = $factory->createResponse(401);
        $response = $response->withHeader('content-type', 'application/json; charset=utf-8');
        $body = $factory->createStream(
            json_encode(
                [
                    'status_code' => 7,
                    'status_message' => 'Invalid API key: You must be granted a valid key.',
                    'success' => false
                ]
            )
        );

        $client = new Client();
        $client->addResponse($response->withBody($body));

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(
                new HttpClient(
                    [
                        'http' => [
                            'client' => $client
                        ]
                    ]
                ),
                $eventDispatcher
            )
        );

        $eventDispatcher->dispatch($event);
    }

    /**
     * @test
     */
    public function verifyItThrowsException()
    {
        $this->expectException(\Exception::class);

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event = new RequestEvent($request);

        $response = $factory->createResponse(418);
        $response = $response->withHeader('content-type', 'application/json; charset=utf-8');
        $body = $factory->createStream('{{}');

        $client = new Client();
        $client->addResponse($response->withBody($body));

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(
                new HttpClient(
                    [
                        'http' => [
                            'client' => $client
                        ]
                    ]
                ),
                $eventDispatcher
            )
        );

        $eventDispatcher->dispatch($event);
    }

    /**
     * @test
     */
    public function verifyItThrowsUnexpectedException()
    {
        $this->expectException(UnexpectedResponseException::class);

        $factory = new Psr17Factory();
        $request = $factory->createRequest('GET', 'https://www.test.com');
        $event = new RequestEvent($request);

        $response = $factory->createResponse(418);
        $response = $response->withHeader('content-type', 'application/text; charset=utf-8');

        $client = new Client();
        $client->addResponse($response);

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new RequestListener(
                new HttpClient(
                    [
                        'http' => [
                            'client' => $client
                        ]
                    ]
                ),
                $eventDispatcher
            )
        );

        $eventDispatcher->dispatch($event);
    }
}
