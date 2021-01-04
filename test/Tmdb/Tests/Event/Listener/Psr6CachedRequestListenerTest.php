<?php

namespace Tmdb\Tests\Event;

use Http\Mock\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Psr6CachedRequestListener;
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
class Psr6CachedRequestListenerTest extends TestCase
{
    /**
     * @test
     */
    public function canCache()
    {
        $factory = new Psr17Factory();
        $event = new RequestEvent($factory->createRequest('GET', 'https://www.test.com'));
        $cache = new ArrayAdapter(0, false);
        $client = new Client();

        $client->setDefaultResponse(
            $factory
                ->createResponse(200)
                ->withHeader('cache-control', 'public, s-maxage=3600')
                ->withHeader('expires', 'Fri, 9 Jan 2060 07:28:00 GMT')
                ->withHeader('ETag', md5(time()))
        );

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new Psr6CachedRequestListener(
                new HttpClient(['http' => ['client' => $client]]),
                $eventDispatcher,
                $cache,
                $factory
            )
        );

        $eventDispatcher->dispatch($event);

        $this->assertEquals(200, $event->getResponse()->getStatusCode());
        $this->assertEquals(1, count($cache->getValues()));
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
        $event = new RequestEvent($factory->createRequest('GET', 'https://www.test.com'));
        $cache = new ArrayAdapter(0, false);
        $client = new Client();

        $response = $factory->createResponse(401)
            ->withHeader('cache-control', 'public, s-maxage=3600')
            ->withHeader('expires', 'Fri, 9 Jan 2060 07:28:00 GMT')
            ->withHeader('ETag', md5(time()));

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
            new Psr6CachedRequestListener(
                new HttpClient(['http' => ['client' => $client]]),
                $eventDispatcher,
                $cache,
                $factory
            )
        );

        $eventDispatcher->dispatch($event);
    }

    /**
     * @test
     */
    public function verifyItThrowsRegularException()
    {
        $this->expectException(\Exception::class);

        $factory = new Psr17Factory();
        $event = new RequestEvent($factory->createRequest('GET', 'https://www.test.com'));
        $cache = new ArrayAdapter(0, false);
        $client = new Client();

        $response = $factory->createResponse(418)
            ->withHeader('cache-control', 'public, s-maxage=3600')
            ->withHeader('expires', 'Fri, 9 Jan 2060 07:28:00 GMT')
            ->withHeader('ETag', md5(time()));
        $response = $response->withHeader('content-type', 'application/json; charset=utf-8');
        $body = $factory->createStream('{{}');

        $client = new Client();
        $client->addResponse($response->withBody($body));

        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(
            RequestEvent::class,
            new Psr6CachedRequestListener(
                new HttpClient(['http' => ['client' => $client]]),
                $eventDispatcher,
                $cache,
                $factory
            )
        );

        $eventDispatcher->dispatch($event);
    }
}
